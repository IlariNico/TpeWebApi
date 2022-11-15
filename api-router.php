<?php
require_once 'libs/Router.php';
require_once 'app/controllers/product.controller.php';

$router = new Router();
$router->addRoute('products', 'GET', 'productController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'productController', 'getProduct');
$router->addRoute('products/:ID', 'DELETE', 'productController', 'delProduct');
$router->addRoute('products/', 'DELETE', 'productController', 'delProduct');
$router->addRoute('products', 'POST', 'productController', 'insertProd');
$router->addRoute('products/:ID', 'PUT', 'productController', 'modProd');
$router->addRoute('products/', 'PUT', 'productController', 'modProd');
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);