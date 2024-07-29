<?php

use Class\App;
use Controller\ProductController;
use Router\Router;

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
define('BASE_ADMIN_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

$router = new Router();

//routes publiques
//Home
$router->register('/', ['Controller\HomeController', 'index']);

//Products
$router->register('/products', ['Controller\ProductController', 'index']);
$router->register('/products_detail/{id}', ['Controller\ProductController', 'detail']);

//Login
$router->register('/login', ['Controller\LoginController', 'login']);
$router->register('/registration', ['Controller\LoginController', 'registration']);
$router->register('/logout', ['Controller\LoginController', 'logout']);

//routes d'administration
$router->register('/admin/products', ['Controller\AdminController', 'listProducts']);

(new App($router, $_SERVER['REQUEST_URI']))->run();

