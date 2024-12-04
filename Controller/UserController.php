<?php

namespace Controller;

use Src\Renderer;
use JetBrains\PhpStorm\NoReturn;
use Model\UserModel;

class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function isAdmin(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Régénération de l'identifiant de session pour éviter la fixation de la session
        session_regenerate_id(true);

        // Vérifie que l'identifiant de l'utilisateur est défini dans la session
        if (!isset($_SESSION['userId'])) {
            return false;
        }

        $userId = $_SESSION['userId'];
        return $this->userModel->isAdmin($userId);
    }

    public function getUserList(): array
    {
        return $this->userModel->getAll();
    }

    public function getUserById($id): array
    {
        // Valide et assainit les données
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            return [];
        }

        return $this->userModel->getByID($id);
    }

    public function deleteUser($id): void
    {
        // Valide et assainit les données
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            // Enregistre l'erreur
            error_log("Id utilisateur invalide: $id");
            header("Location: /admin/users");
            exit();
        }

        $this->userModel->delete($id);

        header("Location: /admin/users");
        exit();
    }

    public function changeUserPrivileges($id): void
    {
        // Valide et assainit les données
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            // Enregistre l'erreur
            error_log("Id utilisateur invalide: $id");
            header("Location: /admin/users");
            exit();
        }

        $this->userModel->toggleAdminStatus($id);

        header("Location: /admin/users");
        exit();
    }
}