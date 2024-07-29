<?php

namespace Controller;

use Class\Renderer;
use Model\ProductModel;
use Model\UserModel;

class AdminController
{
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleAdminRequest(): void
    {
        if (!$this->isAuthenticated() || !$this->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }

        // Logique de la page admin
        //TODO
    }

    private function isAuthenticated(): bool {
        return isset($_SESSION['userId']);
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

        $productModel = new ProductModel();
        $products = $productModel->getAll();

        return Renderer::make('products', ['products' => $products], 'admin');
    }
}