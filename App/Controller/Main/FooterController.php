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
        // send current request url
        $data['path'] = $this->request->url();

        return $this->view->render('main/footer', $data);
    }
}
