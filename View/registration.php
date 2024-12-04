<?php
use Controller\LoginController;
use Src\CsrfHelper;

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

$loginController = new LoginController();
$loginController->handleRequest();

if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
    <div class="errors text-center m-2 text-red-500">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
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

    <h1 class="text-center text-4xl font-bold mb-8 text-gray-800">Inscription</h1>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <form method="POST" action="" class="bg-white shadow-md rounded-lg p-8 w-full max-w-sm">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(CsrfHelper::generateCsrfToken()); ?>">

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
                        name="registration"
                        value="S'inscrire"
                        class="w-full inline-block rounded-lg bg-indigo-600 px-8 py-3 text-sm font-medium text-white transition hover:scale-105 hover:shadow-lg focus:outline-none focus:ring focus:ring-indigo-300 active:bg-indigo-500 cursor-pointer"
                >
            </div>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">Déjà inscrit ? <a href="/login" class="text-indigo-600 hover:text-indigo-800 font-bold transition duration-300">Connectez-vous ici</a></p>
            </div>
        </form>
    </div>


