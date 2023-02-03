<?php

namespace App\Dao;

class Product
{
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
	 * product attributes
	 * 
	 * @var array
	 */
	private $attr;

	public function __construct($sku, $name, $price, $attr)
	{
		$this->sku = $sku;
		$this->name = $name;
		$this->price = $price;
		$this->attr = $attr;
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
	 * Get product attributes
	 * 
	 * @return string
	 */
	public function attr()
	{
		return $this->attr;
	}
}
