<?php

namespace App\Dao\product;

use App\Dao\product\Product;
use App\Dao\product\Dvd;
use App\Dao\product\Book;
use App\Dao\product\Furniture;

class ProductBuilder
{
	/**
	 * Product Builder object
	 *
	 * @var ProductBuilder
	 */
	private static $instance;

	/**
	 * Constructor
	 */
	private function __construct()
	{
		static::$instance = $this;
	}

	/**
	 * get instance
	 * 
	 * @return ProductBuilder
	 */
	public static function getInstance()
	{
		if (is_null(static::$instance)) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * build product object
	 * 
	 * @return Product
	 */
	public function build($id, $sku, $name, $price, $type, $attr)
	{
		$productTypes = [
			'dvd' => 'Dvd',
			'book' => 'Book',
			'furniture' => 'Furniture',
		];

		$productType = $productTypes[$type];

		$productClass = 'App\Dao\product\\' . $productType;

		$productObj = new $productClass($id, $sku, $name, $price, $attr);

		return $productObj;
	}
}
