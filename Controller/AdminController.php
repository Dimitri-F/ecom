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
        $this->checkAdminAccess();

        $products = $this->productModel->getAll();

        return Renderer::make('products', ['products' => $products], 'admin');
    }

    public function createView(): Renderer{
        $this->checkAdminAccess();

        return Renderer::make('create_product', [], 'admin');
    }

    public function createProduct(): void
    {
        $this->checkAdminAccess();

        $category_id = $_POST['category_id'];
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = $_POST['price'];

        // Gestion de la photo
        $photoPath = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name'];
            $photoPath = dirname(__DIR__) . '/Public/uploads/' . basename($photo);

            // Vérifier le succès du déplacement du fichier
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                $_SESSION['message'] = "Erreur lors du téléchargement de la photo. : " . $photoPath;
                header("Location: /admin/create_product");
                exit;
            }
        }

        // Création du produit
        $created = $this->productModel->create($category_id, $name, $description, $price, $photo);

        if ($created) {
            $_SESSION['message'] = "Produit créé avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la création du produit.";
        }

        header("Location: /admin/products");
    }


    #[NoReturn] public function deleteProduct($id): void
    {
      $this->checkAdminAccess();

      $this->productModel->delete($id);

      header("Location: /admin/products");
      exit();
    }

    public function editView($id): Renderer
    {
        $this->checkAdminAccess();

        $product = $this->productModel->getByID($id);
        return Renderer::make('edit_product', ['product' => $product], 'admin');
    }

    public function updateProduct(): void
    {
        $this->checkAdminAccess();

        $id = $_POST['id'];
        $category_id = $_POST['category_id'];
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = $_POST['price'];

        // Gestion de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name'];
//            $photoPath = dirname(__DIR__) . '/pu/uploads/' . basename($photo);
            $photoPath = dirname(__DIR__) . '/Public/uploads/' . basename($photo);

            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
                $_SESSION['message'] = "Erreur lors du téléchargement de la photo.";
                header("Location: /admin/edit_view/{$id}");
                exit;
            }
        } else {
            // Conserver l'ancienne photo si aucune nouvelle photo n'est téléchargée
            $photo = $this->productModel->getProductPhoto($id);
        }

        // Mise à jour du produit
        $updated = $this->productModel->update($id, $category_id, $name, $description, $price, $photo);

        if ($updated) {
            $_SESSION['message'] = "Produit mis à jour avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour du produit.";
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

    // Méthode pour vérifier si l'utilisateur est un administrateur
    private function checkAdminAccess(): void
    {
        if (!$this->isAdmin()) {
            $_SESSION['message'] = "Accès refusé.";
            header("Location: /login");
            exit();
        }
    }

}