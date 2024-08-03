<?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

?>

<h1>ADMIN : Liste des produits</h1>

<a href="/admin/create_view">+ Nouveau produit</a>
        <table id="productsTable" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($products)) {

                foreach ($products as $product): ?>

                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td><?= $product['category_id'] ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td><img src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                        <td>
                            <a href="/admin/edit_view/<?= $product['id'] ?>">Modifier</a>
                            <a href="/admin/delete_product/<?=$product['id']?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;
            } ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#productsTable').DataTable({
                });
            });
        </script>