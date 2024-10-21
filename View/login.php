<?php
use Controller\LoginController;

$loginController = new LoginController();
$loginController->handleRequest();
?>


<!--<h1 class="text-center">CONNEXION PAGE</h1>-->
<!--<div class="flex items-center justify-center">-->
<!--    <form method="POST" action="" class="m-5">-->
<!--        <div>-->
<!--            <label for="pseudo"></label>-->
<!--            <input type="text" name="pseudo">-->
<!--        </div>-->
<!--        <div>-->
<!--            <label for="password"></label>-->
<!--            <input type="password" name="password">-->
<!--        </div>-->
<!--        <input class="inline-block rounded bg-indigo-600 my-5 px-8 py-3 text-sm font-medium text-white transition hover:scale-110 hover:shadow-xl focus:outline-none focus:ring active:bg-indigo-500" type="submit" name="login">-->
<!--    </form>-->
<!--</div>-->
<!--<div class="text-center my-5">-->
<!--    <a href="/registration" class="block lg:inline-block text-md font-bold  text-orange-500  sm:hover:border-indigo-400  hover:text-orange-500 mx-2 focus:text-blue-500  p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg" >Créer un compte</a>-->
<!--</div>-->

<h1 class="text-center text-4xl font-bold mb-8 text-gray-800">Connexion</h1>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <form method="POST" action="" class="bg-white shadow-md rounded-lg p-8 w-full max-w-sm">
        <!-- Pseudo Field -->
        <div class="mb-6">
            <label for="pseudo" class="block text-gray-700 text-sm font-bold mb-2">Pseudo</label>
            <input
                    type="text"
                    name="pseudo"
                    id="pseudo"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                    placeholder="Entrez votre pseudo"
                    required
            >
        </div>

        <!-- Password Field -->
        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                    placeholder="Entrez votre mot de passe"
                    required
            >
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <input
                    type="submit"
                    name="login"
                    value="Se connecter"
                    class="w-full inline-block rounded-lg bg-indigo-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-105 hover:shadow-lg focus:outline-none focus:ring focus:ring-indigo-300 active:bg-indigo-500 cursor-pointer"
            >
        </div>

        <!-- Create Account Link -->
        <div class="text-center mt-6">
            <a href="/registration" class="text-orange-500 hover:text-orange-600 font-bold transition duration-300">Créer un compte</a>
        </div>
    </form>
</div>


<?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
    <div class="errors">
        <ul>
            <?php foreach ($_SESSION['errors'] as $field => $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['message'])): ?>
    <p><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>


