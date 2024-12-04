<?php
if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<h1 class="text-center text-2xl text-orange-500 font-bold m-4">Modifier un produit</h1>

<?php if (!empty($product)) : ?>
    <form action="/admin/edit_product/<?=$product['id']?>" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-lg shadow-md lg:w-1/2 mx-auto my-5">
        <div class="form-group">
            <label for="id" class="block text-sm font-medium text-gray-700">ID du produit (non modifiable)</label>
            <input type="text" id="id" name="id" readonly value="<?php echo htmlspecialchars($product['id']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="form-group">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
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
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="form-group">
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo (fichier jpg)</label>
            <input type="file" id="photo" name="photo" accept=".jpg" class="mt-1 block w-full text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <small class="text-gray-500">Format accepté : jpg</small>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Mettre à jour le produit
            </button>
        </div>
    </form>
<?php else : ?>
    <p class="mt-8 text-center text-gray-500">l'article n'existe pas.</p>
<?php endif; ?>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="errors text-center text-red-500">
        <ul class="list-disc pl-5">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>
