<?php

use Class\App;
use Router\Router;

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

$router = new Router();

$router->register('/', ['Controller\HomeController', 'index']);

$router->register('/products', ['Controller\ProductController', 'index']);
$router->register('/products_detail/{id}', ['Controller\ProductController', 'detail']);


$router->register('/users', ['Controller\UserController', 'index']);

$router->register('/login', ['Controller\LoginController', 'index']);

(new App($router, $_SERVER['REQUEST_URI']))->run();

