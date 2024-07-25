<?php

use Model\UserModel;

if(isset($_POST['send'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel = new UserModel();
        $insertUser = $userModel->insert($pseudo, $password);
        $recoverUserId = $userModel->recoverUser($pseudo, $password);

        if (!is_null($recoverUserId)){
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recoverUserId;
        }

        header("Location: /");
    }else{
        $_SESSION['message']= "Veuillez remplir tous les champs";
        header("Location: /login");
    }
}