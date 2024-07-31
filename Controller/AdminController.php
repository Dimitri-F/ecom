<?php

namespace Controller;

use Class\Renderer;
use JetBrains\PhpStorm\NoReturn;
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

    #[NoReturn] public function deleteProduct($id): void
    {
        if (!$this->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }

      $this->productModel->delete($id);

      header("Location: /admin/products");
      exit();
    }

    public function editView($id){
        if (!$this->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }

        $product = $this->productModel->getByID($id);
        return Renderer::make('edit_product', ['product' => $product], 'admin');
    }

    public function updateProduct(): void
    {
        $id = $_POST['id'];
        $category_id = $_POST['category_id'];
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = $_POST['price'];

        // Gestion de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name'];
            $photoPath = 'uploads/' . basename($photo);

            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                $_SESSION['message'] = "Erreur lors du téléchargement de la photo.";
                header("Location: /admin/products/edit_view/{$id}");
                exit;
            }
        } else {
            // Conserver l'ancienne photo si aucune nouvelle photo n'est téléchargée
            $photoPath = $this->productModel->getProductPhoto($id);
        }

        // Mise à jour du produit
        $updated = $this->productModel->update($id, $category_id, $name, $description, $price, $photoPath);

        if ($updated) {
//            $_SESSION['message'] = "Produit mis à jour avec succès.";
            $_SESSION['message'] = $id;
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour du produit." . " : " . $photoPath ;
        }
        header("Location: /admin/products");
    }

    private function validateForm(array $fields): bool
    {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                return false;
            }
        }
        return true;
    }

}