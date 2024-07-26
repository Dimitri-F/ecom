<?php
use Controller\LoginController;

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

$loginController = new LoginController();
$loginController->handleRequest();
?>

<h1 class="text-center">REGISTRATION PAGE</h1>
<div class="flex items-center justify-center">
    <form method="POST" action="" class="m-5">
        <div>
            <label for="pseudo"></label>
            <input type="text" name="pseudo">
        </div>
        <div>
            <label for="password"></label>
            <input type="password" name="password">
        </div>
        <input class="inline-block rounded bg-indigo-600 my-5 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:outline-none focus:ring active:bg-indigo-500" type="submit" name="registration">
    </form>
</div>

