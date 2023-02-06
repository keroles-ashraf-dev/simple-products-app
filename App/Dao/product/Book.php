<?php

namespace App\Dao\product;

use System\Validation;

class Book extends Product
{
	/**
	 * type
	 * 
	 * @var int
	 */
	protected $type = 'book';

	/**
	 * book wight
	 * 
	 * @var float
	 */
	private $weight;

	/**
	 * constructor
	 * 
	 * @param string $sku
	 * @param string $name
	 * @param float $price
	 * @param float $weight
	 * @return void
	 */
	public function __construct($id, $sku, $name, $price, $attr)
	{
		parent::__construct($id, $sku, $name, $price);
		$this->setAttr($attr);
	}

	/**
	 * Get book type
	 * 
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}

	/**
	 * Get book weight
	 * 
	 * @return int
	 */
	public function weight()
	{
		return $this->weight;
	}

	/**
	 * get book attributes
	 * 
	 * @return string
	 */
	private function attr()
	{
		$attr = [
			'weight' => $this->weight(),
		];

		return $attr;
	}

	/**
	 * set book attributes
	 * 
	 * @param mixed $attr
	 * @return void
	 */
	public function setAttr($attr)
	{
		$attrArray = $attr;

		if (!is_array($attrArray)) {
			$attrArray = json_decode(html_entity_decode($attr), true);
		}

		$this->weight = $attrArray['weight'];
	}

	/**
	 * prepare data for storing
	 * 
	 * @return array
	 */
	public function toDto()
	{
		$data = parent::toDto();

		$data['type'] = $this->type;
		$data['attr'] = json_encode($this->attr());

		return $data;
	}

	/**
	 * prepare product attributes to display
	 * 
	 * @return string
	 */
	public function displayedAttr()
	{
		$data = 'Weight: '  . $this->weight() . 'KG';

		return $data;
	}

	/**
	 * validate book
	 * 
	 * @param Validation $validator
	 * @return bool
	 */
	public function isValid(Validation $validator)
	{
		parent::isValid($validator);

		$validator->required('weight')->float('weight')->maxLen('weight', 9);

		return $validator->passes();
	}
}
