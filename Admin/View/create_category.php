
<?php
if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>


<h1 class="text-center text-2xl text-orange-500 font-bold m-4">Création d'une nouvelle catégorie</h1>

    <form action="/admin/create_category" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-lg shadow-md lg:w-1/2 mx-auto my-5">

        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border" id="name" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border" id="cat_slug" name="cat_slug" value="<?= htmlspecialchars($_SESSION['old']['cat_slug'] ?? '') ?>" required >
        </div>

        <div class="form-group text-center">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Créer la catégorie</button>
        </div>
    </form>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="errors text-center text-red-500">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php unset($_SESSION['old']); ?>