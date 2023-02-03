<?php

namespace App\Controller;

use System\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $this->html->setTitle('Not Found');

        $view = $this->view->render('not-found');

        return $this->appLayout->render($view);
    }
}
