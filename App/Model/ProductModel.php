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
	public function getProducts()
	{
		$data = $this
			->select('id, sku, name, price, type, attr')
			->from($this->table)
			->fetchAll();

		$products = [];

		foreach ($data as $e) {

			$builder = ProductBuilder::getInstance();

			$product = $builder->build($e->id, $e->sku, $e->name, $e->price, $e->type, $e->attr);

			$products[] = $product;
		}

		return $products;
	}

	/**
	 * delete Product Record By Id
	 *
	 * @param int $id
	 * @return void
	 */
	public function delete($id, $table = null)
	{
		$oldImages = $this->getProductImages($id);
		$oldImagesCount = count($oldImages);

		for ($i = 0; $i < $oldImagesCount; $i++) {
			$this->deleteImage($oldImages[$i]->name);
		}

		$this->where('id = ?', $id)->delete($this->table);
	}
}
