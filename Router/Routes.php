<?php

use Class\App;
use Router\Router;

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

$router = new Router();

$router->register('/', ['Controller\HomeController', 'index']);
$router->register('/articles', ['Controller\ArticleController', 'index']);
$router->register('/clients', ['Controller\ClientController', 'index']);

(new App($router, $_SERVER['REQUEST_URI']))->run();

