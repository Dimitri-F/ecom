<?php

namespace Controller;

use Class\Renderer;
use Model\ProductModel;
use Model\UserModel;

class AdminController
{
    private UserModel $userModel;
    private ProductModel $productModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
    }

    private function isAdmin(): bool {
        $userId = $_SESSION['userId'];
        return $this->userModel->isAdmin($userId);
    }

    public function listProducts(): Renderer{
        if (!$this->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }

        $products = $this->productModel->getAll();

        return Renderer::make('products', ['products' => $products], 'admin');
    }

    public function deleteProduct($id): void
    {
      $this->productModel->deleteById($id);

      $this->listProducts();
    }

}