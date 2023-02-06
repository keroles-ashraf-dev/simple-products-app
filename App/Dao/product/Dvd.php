<?php

namespace App\Dao\product;

use System\Validation;

class Dvd extends Product
{
	/**
	 * type
	 * 
	 * @var int
	 */
	protected $type = 'dvd';

	/**
	 * dvd size
	 * 
	 * @var int
	 */
	private $size;

	/**
	 * constructor
	 * 
	 * @param string $sku
	 * @param string $name
	 * @param float $price
	 * @param mixed $attr
	 * @return void
	 */
	public function __construct($id, $sku, $name, $price, $attr)
	{
		parent::__construct($id, $sku, $name, $price);
		$this->setAttr($attr);
	}

	/**
	 * Get dvd type
	 * 
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}

	/**
	 * Get dvd size
	 * 
	 * @return int
	 */
	public function size()
	{
		return $this->size;
	}

	/**
	 * get dvd attributes
	 * 
	 * @return string
	 */
	private function attr()
	{
		$attr = [
			'size' => $this->size(),
		];

		return $attr;
	}

	/**
	 * set dvd attribute
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

		$this->size = $attrArray['size'];
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
		$data = 'Size: '  . $this->size . 'MB';

		return $data;
	}

	/**
	 * validate dvd
	 * 
	 * @param Validation $validator
	 * @return bool
	 */
	public function isValid(Validation $validator)
	{
		parent::isValid($validator);

		$validator->required('size')->int('size')->maxLen('size', 9);

		return $validator->passes();
	}
}
