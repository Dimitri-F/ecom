<?php

namespace Controller;

use Class\Renderer;
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
}