<?php

?>

<h1>ADMIN : Liste des produits<h1>


        <table id="productsTable" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($products)) {
                foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td>
                            <a href="/admin/edit-product?id=<?= $product['id'] ?>">Modifier</a>
                            <a href="/admin/delete_product/<?=$product['id']?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;
            } ?>
            </tbody>
        </table>