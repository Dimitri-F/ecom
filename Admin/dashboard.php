<?php

use Controller\AdminController;

$adminController = new AdminController();

$adminController->handleAdminRequest();
?>


<h1>Partie Admin</h1>

<a href="/logout">Déconnexion</a>