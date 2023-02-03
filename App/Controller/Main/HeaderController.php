<?php

namespace App\Controller\Main;

use System\Controller;

class HeaderController extends Controller
{
    /**
     * Displays header
     * 
     * @return mixed
     */
    public function index()
    {
        $data['title'] = $this->html->getTitle();

        return $this->view->render('main/header', $data);
    }
}
