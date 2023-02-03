<?php

namespace App\Controller\Main;

use System\Controller;

class FooterController extends Controller
{
    /**
     * Displays footer
     * 
     * @return mixed
     */
    public function index()
    {
        return $this->view->render('main/footer');
    }
}
