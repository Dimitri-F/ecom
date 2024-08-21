<?php

namespace Controller;

use Class\Renderer;
use JetBrains\PhpStorm\NoReturn;
use Model\UserModel;

class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function isAdmin(): bool {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie que userId est défini dans la session
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
        return $this->userModel->getByID($id);
    }

    #[NoReturn] public function deleteUser($id): void
    {
        $this->userModel->delete($id);

        header("Location: /admin/users");
        exit();
    }

    #[NoReturn] public function changeUserPrivileges($id): void
    {
        $this->userModel->toggleAdminStatus($id);

        header("Location: /admin/users");
        exit();
    }
}