<?php

namespace App\Model;

use System\Model;

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
	 * @return void
	 */
	public function create()
	{
		$images = [];
		$countFiles = count($_FILES);

		for ($i = 0; $i < $countFiles; $i++) {
			$images[] = $this->uploadImage("product-image-$i");
		}

		$id = $this
			->data('category_id', $this->request->post('category-id'))
			->data('name', $this->request->post('name'))
			->data('description', $this->request->post('description'))
			->data('price', $this->request->post('price'))
			->data('available_count', $this->request->post('available-count'))
			->data('status', $this->request->post('status'))
			->insert($this->table)->lastId();

		for ($i = 0; $i < $countFiles; $i++) {
			$this
				->data('product_id', $id)
				->data('name', $images[$i])
				->insert($this->imagesTable);
		}
	}

	/**
	 * Get products records
	 *
	 * @return array
	 */
	public function getProducts()
	{
		return $this
			->select('p.id, p.name, c.id category_id, c.name category_name, p.description, p.price, p.available_count, p.status')
			->from($this->table . ' p')
			->fetchAll();
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
