<?php

namespace Controller;

use Class\FormValidator;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validationResult = FormValidator::validateForm([
                'pseudo' => 'string',
                'password' => 'string'
            ]);

            $errors = $validationResult['errors'];
            $sanitizedData = $validationResult['data'];

            if ($this->userModel->doesPseudoExist($sanitizedData['pseudo'])) {
                $errors['pseudo'] = "Ce pseudo est déjà pris, veuillez en choisir un autre.";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /registration");
                exit;
            }

            $pseudo = $sanitizedData['pseudo'];
            $password = password_hash($sanitizedData['password'], PASSWORD_DEFAULT);

            // Créer l'array $data
            $data = [
                'pseudo' => $pseudo,
                'password' => $password,
                'admin' => 0
            ];

            $this->userModel->create($data);
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validationResult = FormValidator::validateForm([
                'pseudo' => 'string',
                'password' => 'string'
            ]);

            $errors = $validationResult['errors'];
            $sanitizedData = $validationResult['data'];

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: /login");
                exit;
            }

            $pseudo = $sanitizedData['pseudo'];
            $password = $sanitizedData['password'];

            $user = $this->userModel->recoverUser($pseudo);

            if ($user && password_verify($password, $user['password'])) {
                $this->setSession($pseudo, $user['id']);

                if ($user['admin'] == 1) {
                    header("Location: /admin/products");
                } else {
                    header("Location: /");
                }
            } else {
                $_SESSION['errors'] = ['login' => "Votre pseudo ou mot de passe est incorrect..."];
                header("Location: /login");
                exit;
            }
        } else {
            $_SESSION['errors'] = ['form' => "Veuillez remplir tous les champs."];
            header("Location: /login");
            exit;
        }
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