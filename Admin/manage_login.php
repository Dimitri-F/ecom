<?php

use Model\UserModel;

$userModel = new UserModel();

if(isset($_POST['registration'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $insertUser = $userModel->insert($pseudo, $password);
        $userId = $userModel->recoverUserId($pseudo, $password);

        if (!is_null($userId)){
            $_SESSION['userPseudo'] = $pseudo;
            $_SESSION['userId'] = $userId;
        }

        header("Location: /");
    }else{
        $_SESSION['message']= "Veuillez remplir tous les champs";
        header("Location: /registration");
    }
}


if (isset($_POST['login'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = $_POST['password'];

        // Récupérer les informations de l'utilisateur depuis la base de données
        $user = $userModel->recoverUser($pseudo);

        // Vérifier si l'utilisateur existe et comparer les mots de passe
        if ($user && password_verify($password, $user['password'])) {
            // Mot de passe correct, connecter l'utilisateur
            $_SESSION['userPseudo'] = $pseudo;
            $_SESSION['userId'] = $user['id'];
            header("Location: /");
        } else {
            // Mot de passe ou pseudo incorrect
            $_SESSION['message'] = "Votre pseudo ou mot de passe est incorrect...";
            header("Location: /login");
        }

    } else {
        $_SESSION['message'] = "Veuillez remplir tous les champs";
        header("Location: /login");
    }
}
