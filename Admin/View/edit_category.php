<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>3

<h1 class="text-center text-2xl text-orange-500 font-bold m-4">Modifier une catégorie</h1>

<?php if (!empty($category)) : ?>
    <form action="/admin/edit_category/<?=$category['id']?>" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-8 rounded-lg shadow-md lg:w-1/2 mx-auto my-5">

        <div class="form-group">
            <label for="id" class="block text-sm font-medium text-gray-700">ID de la category (non modifiable)</label>
            <input type="text" id="id" name="id" readonly value="<?php echo htmlspecialchars($category['id']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom de la catégorie</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
        </div>

        <div class="form-group">
            <label for="cat_slug" class="block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" id="cat_slug" name="cat_slug" value="<?php echo htmlspecialchars($category['cat_slug']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  required >
        </div>

        <div class="form-group text-center">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Mettre à jour la catégorie</button>
        </div>
    </form>
<?php else : ?>
    <p class="mt-8 text-center text-gray-500">la catégorie n'existe pas.</p>
<?php endif; ?>

<?php if (isset($_SESSION['errors'])): ?>
    <div class="errors">
        <ul>
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

