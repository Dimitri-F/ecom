<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<h1 class="text-2xl font-bold mb-4">ADMIN : Liste des produits</h1>

<a class="m-6 inline-block rounded-md bg-blue-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-blue-600 transition duration-300" href="/admin/create_product_view">+ Nouveau produit</a>

<!-- Conteneur principal -->
<div class="overflow-x-auto">
    <table id="productsTable" class="hidden lg:table min-w-full bg-white border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-3 px-4 text-left">ID</th>
            <th class="py-3 px-4 text-left">Nom</th>
            <th class="py-3 px-4 text-left">Description</th>
            <th class="py-3 px-4 text-left">Catégorie</th>
            <th class="py-3 px-4 text-left">Prix</th>
            <th class="py-3 px-4 text-left">Photo</th>
            <th class="py-3 px-4 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($products)) {
            foreach ($products as $product): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4"><?= $product['id'] ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['name']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['description']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['category_name']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['price']) ?> €</td>
                    <td class="py-2 px-4">
                        <img class="object-contain h-24 w-24" src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </td>
                    <td class="py-2 px-4">
                        <a class="m-2 inline-block rounded-md bg-yellow-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-yellow-600 transition duration-300" href="/admin/edit_product_view/<?= $product['id'] ?>">Modifier</a>
                        <a class="m-2 inline-block rounded-md bg-red-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-red-600 transition duration-300" href="/admin/delete_product/<?= $product['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
    </table>

    <!-- Version empilée pour petits écrans -->
    <div class="lg:hidden">
        <?php if (isset($products)) {
            foreach ($products as $product): ?>
                <div class="border-b p-4">
                    <!-- Image au-dessus -->
                    <div class="mb-4">
                        <img class="object-contain h-32 w-full" src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                    <!-- Détails du produit -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-600"><strong>ID :</strong> <?= $product['id'] ?></p>
                        <p class="text-sm text-gray-600"><strong>Nom :</strong> <?= htmlspecialchars($product['name']) ?></p>
                        <p class="text-sm text-gray-600"><strong>Description :</strong> <?= htmlspecialchars($product['description']) ?></p>
                        <p class="text-sm text-gray-600"><strong>Catégorie :</strong> <?= htmlspecialchars($product['category_name']) ?></p>
                        <p class="text-sm text-gray-600"><strong>Prix :</strong> <?= htmlspecialchars($product['price']) ?> €</p>
                    </div>
                    <!-- Boutons en dessous -->
                    <div class="flex justify-between">
                        <a class="inline-block rounded-md bg-yellow-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-yellow-600 transition duration-300" href="/admin/edit_product_view/<?= $product['id'] ?>">Modifier</a>
                        <a class="inline-block rounded-md bg-red-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-red-600 transition duration-300" href="/admin/delete_product/<?= $product['id'] ?>">Supprimer</a>
                    </div>
                </div>
            <?php endforeach;
        } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            responsive: true,
        });
    });
</script>
