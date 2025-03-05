<?php

namespace Controller;

use Src\Renderer;
use JetBrains\PhpStorm\NoReturn;

class AdminController
{
    private UserController $userController;
    private ProductController $productController;
    private CategoryController $categoryController;
    private OrderController $orderController;

    public function __construct() {
        $this->userController = new UserController();
        $this->productController = new ProductController();
        $this->categoryController = new CategoryController();
        $this->orderController = new OrderController();
    }

    //PRODUCTS
    public function listProducts(): Renderer{

        $this->checkAdminAccess();

        $products = $this->productController->getListProduct();

        return Renderer::make('products', ['products' => $products], 'admin');
    }

    public function createViewProduct(): Renderer
    {
        $this->checkAdminAccess();

        $categories = $this->categoryController->getCategoryList();

        return Renderer::make('create_product', ['categories' => $categories], 'admin');
    }

    public function adminCreateProduct(): void
    {
        $this->checkAdminAccess();

        $this->productController->createProduct($_POST);
    }

    public function adminDeleteProduct($id): void
    {

      $this->checkAdminAccess();

      $this->productController->deleteProduct($id);
    }


    public function updateViewProduct($id): Renderer
    {
        $this->checkAdminAccess();

        $product = $this->productController->getProductById($id);
        $categories = $this->categoryController->getCategoryList();

        return Renderer::make('edit_product', ['product' => $product, 'categories' => $categories], 'admin');
    }

     public function adminUpdateProduct(): void
    {
        $this->checkAdminAccess();

        $this->productController->updateProduct();
    }

    //USERS

    // Méthode pour vérifier si l'utilisateur est un administrateur
    private function checkAdminAccess(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id();
            $_SESSION['initiated'] = true;
        }

        if (!$this->userController->isAdmin()) {
            $_SESSION['message'] = "Accès refusé. Connectez-vous en tant qu'administrateur.";
            header("Location: /login");
            exit();
        }
    }

    public function listUsers(): Renderer{

        $this->checkAdminAccess();

        $users = $this->userController->getUserList();

        return Renderer::make('users', ['users' => $users], 'admin');
    }

    public function deleteUser($id): void
    {

        $this->checkAdminAccess();

        $this->userController->deleteUser($id);
    }

    public function changeUserStatus($id): void
    {

        $this->checkAdminAccess();

        $this->userController->changeUserPrivileges($id);
    }

    //CATEGORY

    public function listCategories(): Renderer{

        $this->checkAdminAccess();

        $categories = $this->categoryController->getCategoryList();

        return Renderer::make('categories', ['categories' => $categories], 'admin');
    }

    public function updateViewCategory($id): Renderer
    {
        $this->checkAdminAccess();

        $category = $this->categoryController->getCategoryById($id);

        return Renderer::make('edit_category', ['category' => $category], 'admin');
    }

    public function adminUpdateCategory(): void
    {
        $this->checkAdminAccess();

        $this->categoryController->updateCategory();
    }

    public function createViewCategory(): Renderer
    {
        $this->checkAdminAccess();

        return Renderer::make('create_category', [], 'admin');
    }

    public function adminCreateCategory(): void
    {
        $this->checkAdminAccess();

        $this->categoryController->createCategory($_POST);
    }

    public function adminDeleteCategory($id): void
    {

        $this->checkAdminAccess();

        $this->categoryController->deleteCategory($id);
    }

    public function listOrders(): Renderer{

        $this->checkAdminAccess();

        $orders = $this->orderController->getOrderList();

        // Parcourir chaque commande
        foreach ($orders as &$order) {
            // Si le champ products est non nul, décoder le JSON, sinon définir un tableau vide
            $order['products'] = isset($order['products']) ? json_decode($order['products'], true) : [];

            // Si la conversion en tableau échoue, on initialise à un tableau vide
            if (!is_array($order['products'])) {
                $order['products'] = [];
            }
        }

        return Renderer::make('orders', ['orders' => $orders], 'admin');
    }
}