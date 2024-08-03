<?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>

<h1>Création nouveau produit</h1>
<form action="/admin/create_product" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="category_id">Catégorie</label>
        <select id="category_id" name="category_id" required>
            <option value="1">Laptop</option>
            <option value="2">Desktop PC</option>
            <option value="3">Tablet</option>
        </select>
    </div>

    <div class="form-group">
        <label for="name">Nom du produit</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix</label>
        <input type="number" id="price" name="price" step="0.01" required>
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