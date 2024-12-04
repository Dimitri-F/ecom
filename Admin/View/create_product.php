
<?php
if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<h1 class="text-center text-2xl text-orange-500 font-bold m-4">Création d'un nouveau produit</h1>

<form action="/admin/create_product" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-lg shadow-md lg:w-1/2 mx-auto my-5">

    <div class="form-group">
        <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
        <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border" id="category_id" name="category_id" required>
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= (isset($_SESSION['old']['category_id']) && $_SESSION['old']['category_id'] == $category['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="">Aucune catégorie disponible</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
        <input type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>"  required >
    </div>

    <div class="form-group">
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  required><?= htmlspecialchars($_SESSION['old']['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
        <input type="number" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border" name="price" step="0.01" value="<?= htmlspecialchars($_SESSION['old']['price'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="photo" class="block text-sm font-medium text-gray-700">Photo (fichier jpg)</label>
        <input type="file" id="photo"class="mt-1 block w-full text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="photo" accept=".jpg" required>
        <small class="text-gray-500">Format accepté : jpg</small>
    </div>

    <div class="form-group text-center">
        <button  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Créer le produit</button>
    </div>
</form>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="errors text-center text-red-500 m-5">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php unset($_SESSION['old']); ?>




