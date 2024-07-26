<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<h1 class="text-center">CONNEXION PAGE</h1>
<div class="flex items-center justify-center">
    <form method="POST" action="../Admin/manage_login.php" class="m-5">
        <div>
            <label for="pseudo"></label>
            <input type="text" name="pseudo">
        </div>
        <div>
            <label for="password"></label>
            <input type="password" name="password">
        </div>
        <input class="inline-block rounded bg-indigo-600 my-5 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:outline-none focus:ring active:bg-indigo-500" type="submit" name="login">
    </form>
</div>
<div class="text-center my-5">
    <a href="/registration" class="block lg:inline-block text-md font-bold  text-orange-500  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg" >Créer un compte</a>
</div>



