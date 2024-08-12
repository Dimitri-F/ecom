<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<h1>Modifier une catégorie</h1>

<?php if (!empty($category)) : ?>
    <form action="/admin/edit_category/<?=$category['id']?>" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="id">ID de la category (non modifiable)</label>
            <input type="text" id="id" name="id" readonly value="<?php echo htmlspecialchars($category['id']); ?>">
        </div>

        <div class="form-group">
            <label for="name">Nom de la catégorie</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="cat_slug">Slug</label>
            <input type="text" id="cat_slug" name="cat_slug" value="<?php echo htmlspecialchars($category['cat_slug']); ?>"  required >
        </div>

        <div class="form-group">
            <button type="submit">Mettre à jour la catégorie</button>
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

