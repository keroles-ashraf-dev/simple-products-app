<?php

use System\Application;

$app = Application::getInstance();

$app->share('appLayout', function ($app) {
    return $app->load->controller('Main/Layout');
});

// register routes
include('routes/web.php');
