<?php

namespace App\Controller;

use System\Controller;
use App\Dao\Product;
use App\Dao\product\ProductBuilder;

class ProductController extends Controller
{
    /**
     * Display Products List
     *
     * @return mixed
     */
    public function index()
    {
        $productModel = $this->load->model('Product');

        $products = $productModel->getProducts();

        $data['products'] = $products;

        $this->html->setTitle('Products');

        $view = $this->view->render('product/products', $data);

        return $this->appLayout->render($view);
    }

    /**
     * Display add product
     *
     * @return mixed
     */
    public function showAddProduct()
    {
        $this->html->setTitle('Add Product');

        $view = $this->view->render('product/add');

        return $this->appLayout->render($view);
    }

    /**
     * Submit for adding product
     *
     * @return string | json
     */
    public function submitAddProduct()
    {
        $validator = $this->validator;

        $product = $this->buildProduct();

        if (!$product->isValid($validator)) {
            $json['success'] = false;
            $json['message'] = flatten($this->validator->getErrors());
            return json_encode($json);
        }

        $productsModel = $this->load->model('Product');

        $success = $productsModel->create($product);

        if (!$success) {
            $json['success'] = false;
            $json['message'] = 'Something wrong happens, try again later';
            return json_encode($json);
        }

        $json['success'] = true;
        $json['message'] = 'Product created successfully';
        $json['redirect_to'] = url('/products');
        return json_encode($json);
    }

    /**
     * build product object
     * 
     * @return Product
     */
    private function buildProduct()
    {
        $builder = ProductBuilder::getInstance();

        $product = $builder->build(
            -1,
            $this->request->requestValue('sku'),
            $this->request->requestValue('name'),
            $this->request->requestValue('price'),
            $this->request->requestValue('product-type'),
            $this->request->requestInputs(),
        );

        return $product;
    }
}
