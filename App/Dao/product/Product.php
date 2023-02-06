<?php

namespace App\Dao\product;

use System\Validation;

abstract class Product
{
	/**
	 * product id
	 * 
	 * @var int
	 */
	private $id;

	/**
	 * product sku
	 * 
	 * @var string
	 */
	private $sku;

	/**
	 * product name
	 * 
	 * @var string
	 */
	private $name;

	/**
	 * product price
	 * 
	 * @var float
	 */
	private $price;

	/**
	 * product type
	 * 
	 * @var string
	 */
	protected $type;

	/**
	 * constructor
	 * 
	 * @param string $sku
	 * @param string $name
	 * @param float $price
	 * @return void
	 */
	public function __construct($id, $sku, $name, $price)
	{
		$this->id = $id;
		$this->sku = $sku;
		$this->name = $name;
		$this->price = $price;
	}

	/**
	 * Get product id
	 * 
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * Get product sku
	 * 
	 * @return string
	 */
	public function sku()
	{
		return $this->sku;
	}

	/**
	 * Get product name
	 * 
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * Get product price
	 * 
	 * @return float
	 */
	public function price()
	{
		return $this->price;
	}

	/**
	 * prepare for storing
	 * 
	 * @return array
	 */
	public function toDto()
	{
		$data = [
			'sku' => $this->sku(),
			'name' => $this->name(),
			'price' => $this->price(),
		];

		return $data;
	}

	/**
	 * prepare product attributes to display
	 * 
	 * @return string
	 */
	abstract public function displayedAttr();

	/**
	 * validate product
	 * 
	 * @param Validation $validator
	 * @return bool
	 */
	public function isValid(Validation $validator)
	{
		$validator->required('sku')->text('sku')->maxLen('sku', 64)->unique('sku', ['products', 'sku']);
		$validator->required('name')->text('name')->maxLen('name', 255);
		$validator->required('price')->float('price')->maxLen('price', 9);
		$validator->required('product-type')->text('product-type')->maxLen('product-type', 64);

		return $validator->passes();
	}
}
