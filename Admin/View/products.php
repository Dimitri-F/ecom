<?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

?>

<h1>ADMIN : Liste des produits</h1>

<a class="m-6 inline-block rounded-md bg-blue-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-blue-600 transition duration-300" href="/admin/create_product_view">+ Nouveau produit</a>
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
                        <td><?= $product['category_name'] ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td><img  class="object-contain h-48 w-48" src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"></td>
                        <td>
                            <a class="m-2 inline-block rounded-md bg-yellow-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-yellow-600 transition duration-300" href="/admin/edit_product_view/<?= $product['id'] ?>">Modifier</a>
                            <a class="m-2 inline-block rounded-md bg-red-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-red-600 transition duration-300" href="/admin/delete_product/<?=$product['id']?>">Supprimer</a>
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