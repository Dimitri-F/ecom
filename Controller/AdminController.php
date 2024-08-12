<?php

namespace Controller;

use Class\Renderer;
use JetBrains\PhpStorm\NoReturn;

class AdminController
{
    private UserController $userController;
    private ProductController $productController;
    private CategoryController $categoryController;

    public function __construct() {
        $this->userController = new UserController();
        $this->productController = new ProductController();
        $this->categoryController = new CategoryController();
    }

    //PRODUCTS

    public function listProducts(): Renderer{

        $this->checkAdminAccess();

        $products = $this->productController->getList();

        return Renderer::make('products', ['products' => $products], 'admin');
    }

    public function createViewProduct(): Renderer
    {
        $this->checkAdminAccess();

        return Renderer::make('create_product', [], 'admin');
    }

    #[NoReturn] public function adminCreateProduct(): void
    {
        $this->checkAdminAccess();

        $this->productController->createProduct($_POST);
    }

    #[NoReturn] public function adminDeleteProduct($id): void
    {

      $this->checkAdminAccess();

      $this->productController->deleteProduct($id);
    }

    public function updateViewProduct($id): Renderer
    {
        $this->checkAdminAccess();

        $product = $this->productController->getProductById($id);

        return Renderer::make('edit_product', ['product' => $product], 'admin');
    }

    #[NoReturn] public function adminUpdateProduct(): void
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

        if (!$this->userController->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }
    }

    public function listUsers(): Renderer{

        $this->checkAdminAccess();

        $users = $this->userController->getList();

        return Renderer::make('users', ['users' => $users], 'admin');
    }

    #[NoReturn] public function deleteUser($id): void
    {

        $this->checkAdminAccess();

        $this->userController->deleteUser($id);
    }

    public function changeStatus($id): void
    {

        $this->checkAdminAccess();

        $this->userController->changeUserPrivileges($id);
    }

    //CATEGORY

    public function listCategories(): Renderer{

        $this->checkAdminAccess();

        $categories = $this->categoryController->getList();

        return Renderer::make('categories', ['categories' => $categories], 'admin');
    }

    public function updateViewCategory($id): Renderer
    {
        $this->checkAdminAccess();

        $category = $this->categoryController->getCategoryById($id);

        return Renderer::make('edit_category', ['category' => $category], 'admin');
    }

    #[NoReturn] public function adminUpdateCategory(): void
    {
        $this->checkAdminAccess();

        $this->categoryController->updateCategory();
    }

    public function createViewCategory(): Renderer
    {
        $this->checkAdminAccess();

        return Renderer::make('create_category', [], 'admin');
    }

    #[NoReturn] public function adminCreateCategory(): void
    {
        $this->checkAdminAccess();

        $this->categoryController->createCategory($_POST);
    }

    #[NoReturn] public function adminDeleteCategory($id): void
    {

        $this->checkAdminAccess();

        $this->categoryController->deleteCategory($id);
    }
}