<?php

namespace Controller;

use Class\FormValidator;
use JetBrains\PhpStorm\NoReturn;
use Model\CategoryModel;

class CategoryController
{
    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getCategoryList(): array
    {
        return $this->categoryModel->getAll();
    }

    public function deleteCategory($id): void
    {

        $this->categoryModel->delete($id);

        header("Location: /admin/categories");
        exit();
    }

     #[NoReturn] public function updateCategory(): void
    {
        // Valider les données du formulaire
        $fieldsToValidate = [
            'id' => 'int',
            'name' => 'string',
            'cat_slug' => 'string'
        ];

        $validationResult = FormValidator::validateForm($fieldsToValidate);
        $sanitizedData = $validationResult['data'];
        $errors = $validationResult['errors'];

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /admin/edit_category_view/{$sanitizedData['id']}");
            exit;
        }

        $id = $sanitizedData['id'];
        $name = $sanitizedData['name'];
        $catSlug = $sanitizedData['cat_slug'];


        // Créer l'array $data
        $data = [
            'name' => $name,
            'cat_slug' => $catSlug
        ];

        // Mise à jour du produit
        $updated = $this->categoryModel->update($id, $data);

        if ($updated) {
            $_SESSION['message'] = "Categorie mise à jour avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour de la catégorie.";
        }

        header("Location: /admin/categories");
        exit;
    }

    public function getCategoryById($id): array
    {
        return $this->categoryModel->getByID($id);
    }

    #[NoReturn] public function createCategory(array $postData): void
    {
        // Valider les données du formulaire
        $fieldsToValidate = [
            'name' => 'string',
            'cat_slug' => 'string'
        ];

        $validationResult = FormValidator::validateForm($fieldsToValidate);
        $sanitizedData = $validationResult['data'];
        $errors = $validationResult['errors'];


        // Si des erreurs existent, les stocker en session et rediriger l'utilisateur
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $postData; // Conserve les anciennes données pour les réafficher en cas d'erreur
            header("Location: /admin/create_category_view");
            exit;
        }

        $name = $sanitizedData['name'];
        $catSlug = $sanitizedData['cat_slug'];

        // Créer l'array $data
        $data = [
            'name' => $name,
            'cat_slug' => $catSlug
        ];

        // Création du produit
        $created = $this->categoryModel->create($data);

        if ($created) {
            $_SESSION['message'] = "Catégorie créé avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la création de la catégorie.";
        }

        header("Location: /admin/categories");
        exit;
    }

}