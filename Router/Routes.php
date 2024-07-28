<?php

use Class\App;
use Router\Router;

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

$router = new Router();

$router->register('/', ['Controller\HomeController', 'index']);

$router->register('/products', ['Controller\ProductController', 'index']);
$router->register('/products_detail/{id}', ['Controller\ProductController', 'detail']);


$router->register('/users', ['Controller\UserController', 'index']);

$router->register('/login', ['Controller\LoginController', 'login']);
$router->register('/registration', ['Controller\LoginController', 'registration']);
$router->register('/logout', ['Controller\LoginController', 'logout']);

$router->register('/admin/dashboard', function (){
    require_once '../Admin/dashboard.php';
});

(new App($router, $_SERVER['REQUEST_URI']))->run();

