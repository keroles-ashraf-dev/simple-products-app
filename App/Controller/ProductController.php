<?php

namespace App\Controller;

use System\Controller;

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
        
        $products = [];//$productModel->getProducts();

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
        if (!$this->isAddInputDataValid()) {
            $json['success'] = false;
            $json['message'] = flatten($this->validator->getErrors());
            return json_encode($json);
        }

        $productsModel = $this->load->model('Product');
        $productsModel->create();

        $json['success'] = true;
        $json['message'] = 'Product created successfully';
        $json['redirect_to'] = url('/products');

        return json_encode($json);
    }

    /**
     * Validate product add form
     *
     * @return bool
     */
    private function isAddInputDataValid()
    {
        $this->validator->required('sku')->text('sku')->maxLen('sku', 64);
        $this->validator->required('name')->text('name')->maxLen('name', 255);
        $this->validator->required('price')->float('price')->maxLen('price', 9);

        return $this->validator->passes();
    }
}
