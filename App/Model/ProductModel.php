<?php

namespace App\Model;

use System\Model;
use App\Dao\product\Product;
use App\Dao\product\ProductBuilder;

class ProductModel extends Model
{
	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * Create new product record
	 *
	 * @return bool
	 */
	public function create(Product $product)
	{
		$id = $this->data($product->toDto())->insert($this->table)->lastId();

		if (empty($id)) return false;

		return true;
	}

	/**
	 * Get products records
	 *
	 * @return array
	 */
	public function all()
	{
		$data = $this
			->select('id, sku, name, price, type, attr')
			->from($this->table)
			->fetchAll();

		$builder = ProductBuilder::getInstance();
		$products = [];

		foreach ($data as $e) {

			$product = $builder->build($e->id, $e->sku, $e->name, $e->price, $e->type, $e->attr);

			$products[] = $product;
		}

		return $products;
	}
}
