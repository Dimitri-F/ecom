<?php

namespace Controller;

use Src\FormValidator;
use Src\Renderer;
use JetBrains\PhpStorm\NoReturn;
use Model\CategoryModel;
use Model\ProductModel;

class ProductController
{
    private ProductModel $productModel;
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function showProducts(): Renderer
    {
        $products = $this->getListProduct();

        return Renderer::make('products', ['products' => $products]);
    }

    public function showProductDetail($id): Renderer
    {
        $product = $this->getProductByID($id);

        return Renderer::make('products_detail', ['product' => $product]);
    }

    /**
     * Récupère tous les produits avec les noms de leurs catégories respectives.
     * @return array
     */
    public function getListProduct(): array
    {
        $products = $this->productModel->getAll();

        $categories = $this->categoryModel->getAll();

        // Convertir les catégories en tableau associatif pour un accès facile
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category['id']] = $category['name'];
        }

        // Associer les noms des catégories aux produits
        foreach ($products as &$product) {
            $product['category_name'] = $categoryMap[$product['category_id']] ?? 'Inconnue';
        }

        return $products;
    }

    public function deleteProduct($id): void
    {

        $this->productModel->delete($id);

        header("Location: /admin/products");
        exit();
    }
    public function getProductById($id): array
    {

        return $this->productModel->getByID($id);
    }

    public function createProduct(array $postData): void
    {
        // Valider les données du formulaire
        $fieldsToValidate = [
            'category_id' => 'int',
            'name' => 'string',
            'description' => 'string',
            'price' => 'float'
        ];

        $validationResult = FormValidator::validateForm($fieldsToValidate);
        $sanitizedData = $validationResult['data'];
        $errors = $validationResult['errors'];

        // Valider et gérer la photo
        $fileValidation = FormValidator::validateFile('photo', ['image/jpeg'], 2 * 1024 * 1024, dirname(__DIR__) . '/Public/uploads'); // 2MB max size

        if ($fileValidation['error']) {
            $errors['photo'] = $fileValidation['error'];
        }

        // Si des erreurs existent, les stocker en session et rediriger l'utilisateur
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $postData; // Conserve les anciennes données pour les réafficher en cas d'erreur
            header("Location: /admin/create_product_view");
            exit;
        }

        $data = [
            'category_id' => $sanitizedData['category_id'],
            'name' => $sanitizedData['name'],
            'description' => $sanitizedData['description'],
            'price' => $sanitizedData['price'],
            'photo' => $fileValidation['filePath'] ? basename($fileValidation['filePath']) : null
        ];

        // Création du produit
        $created = $this->productModel->create($data);

        if ($created) {
            $_SESSION['message'] = "Produit créé avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la création du produit.";
        }

        header("Location: /admin/products");
        exit;
    }

    public function updateProduct(): void
    {
        // Valider les données du formulaire
        $fieldsToValidate = [
            'id' => 'int',
            'category_id' => 'int',
            'name' => 'string',
            'description' => 'string',
            'price' => 'float'
        ];

        $validationResult = FormValidator::validateForm($fieldsToValidate);
        $sanitizedData = $validationResult['data'];
        $errors = $validationResult['errors'];

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /admin/edit_product_view/{$sanitizedData['id']}");
            exit;
        }

        $id = $sanitizedData['id'];
        $category_id = $sanitizedData['category_id'];
        $name = $sanitizedData['name'];
        $description = $sanitizedData['description'];
        $price = $sanitizedData['price'];

        // Récupérer les détails actuels du produit
        $product = $this->productModel->getByID($id);

        // Valider et gérer la photo seulement si un fichier a été soumis
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileValidation = FormValidator::validateFile('photo', ['image/jpeg'], 2 * 1024 * 1024, dirname(__DIR__) . '/Public/uploads'); // 2MB max size

            if ($fileValidation['error']) {
                $errors['photo'] = $fileValidation['error'];
            } else {
                $photo = basename($fileValidation['filePath']);
            }
        } else {
            // Conserver l'ancienne photo si aucune nouvelle photo n'est téléchargée
            $photo = $product['photo'];
        }

        // Utiliser la catégorie existante si aucune nouvelle catégorie n'est sélectionnée
        if ($category_id === null) {
            $category_id = $product['category_id'];
        }

        // Si des erreurs existent, les stocker en session et rediriger l'utilisateur
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /admin/edit_product_view/{$id}");
            exit;
        }

        // Créer l'array $data
        $data = [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'photo' => $photo
        ];

        // Mise à jour du produit
        $updated = $this->productModel->update($id, $data);

        if ($updated) {
            $_SESSION['message'] = "Produit mis à jour avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour du produit.";
        }

        header("Location: /admin/products");
        exit;
    }

    /**
     * Récupère les détails des produits.
     * @param array $ids
     * @return array
     */
    public function getProductDetails(array $ids): array
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        return $this->productModel->retrieveProductsByIds($placeholders, $ids);
    }

}