<?php

namespace App\Dao\product;

use System\Validation;

class Furniture extends Product
{
	/**
	 * type
	 * 
	 * @var int
	 */
	protected $type = 'furniture';

	/**
	 * furniture height
	 * 
	 * @var float
	 */
	private $height;

	/**
	 * furniture width
	 * 
	 * @var float
	 */
	private $width;

	/**
	 * furniture length
	 * 
	 * @var float
	 */
	private $length;

	public function __construct($id, $sku, $name, $price, $attr)
	{
		parent::__construct($id, $sku, $name, $price);
		$this->setAttr($attr);
	}

	/**
	 * Get furniture type
	 * 
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}

	/**
	 * Get furniture height
	 * 
	 * @return float
	 */
	public function height()
	{
		return $this->height;
	}

	/**
	 * Get furniture width
	 * 
	 * @return float
	 */
	public function width()
	{
		return $this->width;
	}

	/**
	 * Get furniture length
	 * 
	 * @return float
	 */
	public function length()
	{
		return $this->length;
	}

	/**
	 * get furniture attributes
	 * 
	 * @return array
	 */
	private function attr()
	{
		$attr = [
			'height' => $this->height(),
			'width' => $this->width(),
			'length' => $this->length(),
		];

		return $attr;
	}

	/**
	 * set furniture attributes
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

		$this->height = $attrArray['height'];
		$this->width = $attrArray['width'];
		$this->length = $attrArray['length'];
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
		$data = 'Dimension: '  . $this->height . 'x'  . $this->width . 'x'  . $this->length;

		return $data;
	}

	/**
	 * validate furniture
	 * 
	 * @param Validation $validator
	 * @return bool
	 */
	public function isValid(Validation $validator)
	{
		parent::isValid($validator);

		$validator->required('height')->float('height')->maxLen('height', 9);
		$validator->required('width')->float('width')->maxLen('width', 9);
		$validator->required('length')->float('length')->maxLen('length', 9);

		return $validator->passes();
	}
}
