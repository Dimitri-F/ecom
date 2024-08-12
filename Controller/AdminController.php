<?php

namespace Controller;

use Class\Renderer;
use JetBrains\PhpStorm\NoReturn;

class AdminController
{
    private UserController $userController;
    private ProductController $productController;

    public function __construct() {
        $this->userController = new UserController();
        $this->productController = new ProductController();
    }

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

    #[NoReturn] public function createProduct(): void
    {
        $this->checkAdminAccess();

        $this->productController->create($_POST);
    }

    #[NoReturn] public function deleteProduct($id): void
    {

      $this->checkAdminAccess();

      $this->productController->delete($id);
    }

    public function updateViewProduct($id): Renderer
    {
        $this->checkAdminAccess();

        $product = $this->productController->getByID($id);

        return Renderer::make('edit_product', ['product' => $product], 'admin');
    }

    #[NoReturn] public function updateProduct(): void
    {
        $this->checkAdminAccess();

        $this->productController->update();
    }

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

}