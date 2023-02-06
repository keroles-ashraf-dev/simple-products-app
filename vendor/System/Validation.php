<?php

namespace System;

class Validation
{
    /**
     * Application Object
     *
     * @var \System\Application
     */
    private $app;

    /**
     * Errors container
     *
     * @var array
     */
    private $errors = [];

    /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Determine if the given input is not empty
     *
     * @param string $input
     * @param string $customErrorMessage
     * @return $this
     */
    public function required($input, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);

        if ($value === '') {
            $defaultMessage = sprintf('%s is required', ucfirst($input));
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input has is only a-z || A-Z
     *
     * @param string $input
     * @param string $customErrorMessage
     * @return $this
     */
    public function text($input, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);

        if (!preg_match('/^[a-zA-Z0-9,-:\'" ]*$/', $value)) {
            $defaultMessage = sprintf('%s is not valid', ucfirst($input));
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input has int value
     *
     * @param string $input
     * @param string $customErrorMessage
     * @return $this
     */
    public function int($input, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);
        $value = intval($value);

        if (!is_int($value)) {
            $defaultMessage = sprintf('%s Accepts only int', ucfirst($input));
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input is array of integers
     *
     * @param string $input
     * @param string $customErrorMessage
     * @return $this
     */
    public function intArray($input, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);

        foreach ($value as $i) {
            if (!is_int($i)) {
                $defaultMessage = sprintf('%s is invalid', ucfirst($input));
                $message = $customErrorMessage ?: $defaultMessage;
                $this->addError($input, $message);
                break;
            }
        }

        return $this;
    }

    /**
     * Determine if the given input has float value
     *
     * @param string $input
     * @param string $customErrorMessage
     * @return $this
     */
    public function float($input, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);
        $value = floatval($value);

        if (!is_float($value)) {
            $defaultMessage = sprintf('%s Accepts only float', ucfirst($input));
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input value should be at least the given length
     *
     * @param string $input
     * @param int $length
     * @param string $customErrorMessage
     * @return $this
     */
    public function minLen($input, $length, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);


        if (strlen($value) < $length) {
            $defaultMessage = sprintf('%s should be at least %d', ucfirst($input), $length);
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input value should be at most the given length
     *
     * @param string $input
     * @param int $length
     * @param string $customErrorMessage
     * @return $this
     */
    public function maxLen($input, $length, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);

        if (strlen($value) > $length) {
            $defaultMessage = sprintf('%s should be at most %d', ucfirst($input), $length);
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }

        return $this;
    }

    /**
     * Determine if the given input is unique in database
     *
     * @param string $input
     * @param array $databaseData
     * @param string $customErrorMessage
     * @return $this
     */
    public function unique($input, array $databaseData, $customErrorMessage = null)
    {
        if ($this->hasErrors($input)) {
            return $this;
        }

        $value = $this->value($input);

        $table = null;
        $column = null;
        $exceptionColumn = null;
        $exceptionColumnValue = null;

        if (count($databaseData) == 2) {
            list($table, $column) = $databaseData;
        } elseif (count($databaseData) == 4) {
            list($table, $column, $exceptionColumn, $exceptionColumnValue) = $databaseData;
        }

        if ($exceptionColumn and $exceptionColumnValue) {
            $result = $this->app->db->select($column)
                ->from($table)
                ->where($column . ' = ? AND ' . $exceptionColumn . ' != ?', $value, $exceptionColumnValue)
                ->fetch();
        } else {
            $result = $this->app->db->select($column)
                ->from($table)
                ->where($column . ' = ?', $value)
                ->fetch();
        }

        if ($result) {
            $defaultMessage = sprintf('%s already exists, should be unique', ucfirst($input));
            $message = $customErrorMessage ?: $defaultMessage;
            $this->addError($input, $message);
        }
    }

    /**
     * Add Custom Message
     *
     * @param string $message
     * @return $this
     */
    public function message($message)
    {
        $this->errors[] = $message;

        return $this;
    }

    /**
     * Determine if there are any invalid inputs
     *
     * @return bool
     */
    public function fails()
    {
        return !empty($this->errors);
    }

    /**
     * Determine if all inputs are valid
     *
     * @return bool
     */
    public function passes()
    {
        return empty($this->errors);
    }

    /**
     * Get All errors
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->errors;
    }

    /**
     * Get the value for the given input name
     *
     * @param string $input
     * @return mixed
     */
    private function value($input)
    {
        $value = $this->app->request->requestValue($input);

        return $value;
    }

    /**
     * Add input error
     *
     * @param string $input
     * @param string $errorMessage
     * @return void
     */
    private function addError($input, $errorMessage)
    {
        $this->errors[$input] = $errorMessage;
    }

    /**
     * Determine if the given input has previous errors
     *
     * @param string $input
     */
    private function hasErrors($input)
    {
        return array_key_exists($input, $this->errors);
    }

    /**
     * get $errors
     *
     * @return string
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
