<?php

use Class\App;
use Router\Router;

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
define('BASE_ADMIN_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);

$router = new Router();

//routes publiques
//Home
$router->register('/', ['Controller\HomeController', 'showHomePage']);

//Products
$router->register('/products', ['Controller\ProductController', 'showProducts']);
$router->register('/products_detail/{id}', ['Controller\ProductController', 'showDetailProduct']);

//Login
$router->register('/login', ['Controller\LoginController', 'login']);
$router->register('/registration', ['Controller\LoginController', 'registration']);
$router->register('/logout', ['Controller\LoginController', 'logout']);

//Cart
$router->register('/cart', ['Controller\CartController', 'showCart']);
$router->register('/cart_add/{id}', ['Controller\CartController', 'addToCart']);
$router->register('/cart_remove/{id}', ['Controller\CartController', 'removeFromCart']);
$router->register('/cart_update/{id}', ['Controller\CartController', 'updateCart']);
$router->register('/cart_clear', ['Controller\CartController', 'clearCart']);

//Checkout
$router->register('/checkout', ['Controller\CartController', 'showCheckout']);
$router->register('/cancel', ['Controller\PaymentController', 'showCancel']);
$router->register('/success', ['Controller\PaymentController', 'showSuccess']);

//Webhook
$router->register('/webhook', ['Controller\WebhookController', 'handle']);


//routes d'administration
//CRUD Product
$router->register('/admin/products', ['Controller\AdminController', 'listProducts']);
$router->register('/admin/delete_product/{id}', ['Controller\AdminController', 'adminDeleteProduct']);
$router->register('/admin/edit_product_view/{id}', ['Controller\AdminController', 'updateViewProduct']);
$router->register('/admin/edit_product/{id}', ['Controller\AdminController', 'adminUpdateProduct']);
$router->register('/admin/create_product_view', ['Controller\AdminController', 'createViewProduct']);
$router->register('/admin/create_product', ['Controller\AdminController', 'adminCreateProduct']);

//User
$router->register('/admin/users', ['Controller\AdminController', 'listUsers']);
$router->register('/admin/delete_user/{id}', ['Controller\AdminController', 'deleteUser']);
$router->register('/admin/toggle_admin_status/{id}', ['Controller\AdminController', 'changeUserStatus']);

//category
$router->register('/admin/categories', ['Controller\AdminController', 'listCategories']);
$router->register('/admin/delete_category/{id}', ['Controller\AdminController', 'adminDeleteCategory']);
$router->register('/admin/edit_category_view/{id}', ['Controller\AdminController', 'updateViewCategory']);
$router->register('/admin/edit_category/{id}', ['Controller\AdminController', 'adminUpdateCategory']);
$router->register('/admin/create_category_view', ['Controller\AdminController', 'createViewCategory']);
$router->register('/admin/create_category', ['Controller\AdminController', 'adminCreateCategory']);

(new App($router, $_SERVER['REQUEST_URI']))->run();

