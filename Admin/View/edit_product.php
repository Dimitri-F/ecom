<?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>

<h1>Modifier un produit</h1>
<?php if (!empty($product)) : ?>
    <form action="/admin/edit_product/<?=$product['id']?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">ID du produit (non modifiable)</label>
            <input type="text" id="id" name="id" readonly value="<?php echo htmlspecialchars($product['id']); ?>">
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id"  required>
                <option value="1" <?= $product['category_id'] == 1 ? 'selected' : '' ?>>Laptop</option>
                <option value="2" <?= $product['category_id'] == 2 ? 'selected' : '' ?>>Desktop PC</option>
                <option value="3" <?= $product['category_id'] == 3 ? 'selected' : '' ?>>Tablet</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"  required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required ><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>"  required>
        </div>

        <div class="form-group">
            <label for="photo">Photo (fichier jpg)</label>
            <input type="file" id="photo" name="photo" accept=".jpg">
            <small>Format accepté : jpg</small>
        </div>
        <div class="form-group">
            <button type="submit">Mettre à jour le produit</button>
        </div>
    </form>
<?php else : ?>
    <p class="mt-8 text-center text-gray-500">l'article n'existe pas.</p>
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

