<?php
if (isset($_SESSION['message'])) {
    echo htmlspecialchars($_SESSION['message']);
    unset($_SESSION['message']);
}
?>

    <h1>Création nouvelle catégorie</h1>

    <form action="/admin/create_category" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>" >
        </div>

        <div class="form-group">
            <label for="name">Slug</label>
            <input type="text" id="cat_slug" name="cat_slug" value="<?= htmlspecialchars($_SESSION['old']['cat_slug'] ?? '') ?>" >
        </div>

        <div class="form-group">
            <button type="submit">Créer la catégorie</button>
        </div>
    </form>

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

<?php unset($_SESSION['old']); ?>