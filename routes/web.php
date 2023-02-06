<?php

// products routes
$app->route->add('/', 'Product');
$app->route->add('/products', 'Product');

// add products routes
$app->route->add('/products/add', 'Product@showAddProduct');
$app->route->add('/products/add/submit', 'Product@submitAddProduct', 'POST');

// delete products routes
$app->route->add('/products/delete', 'Product@submitDeleteProduct', 'POST');

// Not Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');
