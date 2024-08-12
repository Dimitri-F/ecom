<?php
if (isset($_SESSION['message'])) {
    echo htmlspecialchars($_SESSION['message']);
    unset($_SESSION['message']);
}
?>

<h1>Création nouveau produit</h1>

<form action="/admin/create_product" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id" required>
            <option value="1" <?= (isset($_SESSION['old']['category_id']) && $_SESSION['old']['category_id'] == 1) ? 'selected' : '' ?>>Laptop</option>
            <option value="2" <?= (isset($_SESSION['old']['category_id']) && $_SESSION['old']['category_id'] == 2) ? 'selected' : '' ?>>Desktop PC</option>
            <option value="3" <?= (isset($_SESSION['old']['category_id']) && $_SESSION['old']['category_id'] == 3) ? 'selected' : '' ?>>Tablet</option>
        </select>
    </div>

    <div class="form-group">
        <label for="name">Nom du produit</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>" >
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"  required><?= htmlspecialchars($_SESSION['old']['description'] ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($_SESSION['old']['price'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="photo">Photo (fichier jpg)</label>
        <input type="file" id="photo" name="photo" accept=".jpg">
        <small>Format accepté : jpg</small>
    </div>

    <div class="form-group">
        <button type="submit">Créer le produit</button>
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
