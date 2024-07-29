<?php

namespace Controller;

use Class\Renderer;
use Model\UserModel;

class LoginController
{
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleRequest(): void
    {
        if (isset($_POST['registration'])) {
            $this->registerUser();
        } elseif (isset($_POST['login'])) {
            $this->loginUser();
        }
    }

    private function registerUser(): void
    {
        if ($this->validateForm(['pseudo', 'password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if ($this->userModel->doesPseudoExist($pseudo)) {
                $_SESSION['message'] = "Ce pseudo est déjà pris, veuillez en choisir un autre.";
                header("Location: /registration");
                return;
            }

            $this->userModel->insert($pseudo, $password);
            $userId = $this->userModel->getUserId($pseudo);

            if ($userId !== null) {
                $this->setSession($pseudo, $userId);
                header("Location: /");
            } else {
                $_SESSION['message'] = "Erreur lors de l'enregistrement.";
                header("Location: /registration");
            }
        } else {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: /registration");
        }
    }

    private function loginUser(): void
    {
        if ($this->validateForm(['pseudo', 'password'])) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = $_POST['password'];

            $user = $this->userModel->recoverUser($pseudo);

            if ($user && password_verify($password, $user['password'])) {

                $this->setSession($pseudo, $user['id']);

                if ($user['admin'] == 1) {
                    header("Location: /admin/products");
                } else {
                    header("Location: /");
                }
            } else {
                $_SESSION['message'] = "Votre pseudo ou mot de passe est incorrect...";
                header("Location: /login");
            }
        } else {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: /login");
        }
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

    private function setSession($pseudo, $userId): void
    {
        $_SESSION['userPseudo'] = $pseudo;
        $_SESSION['userId'] = $userId;
    }
        public function login(): Renderer
    {
        return Renderer::make('login');
    }

    public function registration(): Renderer
    {
        return Renderer::make('registration');
    }

    public function logout(): Renderer
    {
        return Renderer::make('logout');
    }

}