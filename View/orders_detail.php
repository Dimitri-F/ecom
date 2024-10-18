<?php ?>

<?php if (!empty($order)) : ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Détail de la commande #<?= htmlspecialchars($order['id']) ?></h1>

    <!-- Informations sur la commande -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold">Informations générales</h2>
        <p class="text-gray-600">Date de la commande : <?= htmlspecialchars($order['order_date']) ?></p>
        <p class="text-gray-600">Total : <?= htmlspecialchars($order['amount']) ?> €</p>
        <p class="text-gray-600">Adresse de livraison : <?= htmlspecialchars($order['street']) . ', '. htmlspecialchars($order['city'])
            . ', '. htmlspecialchars($order['postal_code']).', '. htmlspecialchars($order['country']) ?></p>
    </div>

    <!-- Détail des produits -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Produits commandés</h2>

        <!-- Tableau des produits -->
        <table class="table-auto w-full text-left">
            <thead>
            <tr>
                <th class="px-4 py-2">Produit</th>
                <th class="px-4 py-2">Quantité</th>
                <th class="px-4 py-2">Prix unitaire</th>
                <th class="px-4 py-2">Sous-total</th>
            </tr>
            </thead>
            <tbody>
            <!-- Produit 1 -->
            <tr class="border-b">
                <td class="px-4 py-2">PC de bureau A</td>
                <td class="px-4 py-2">1</td>
                <td class="px-4 py-2">1249.99 €</td>
                <td class="px-4 py-2">1249.99 €</td>
            </tr>
            <!-- Produit 2 -->
            <tr class="border-b">
                <td class="px-4 py-2">Clavier mécanique</td>
                <td class="px-4 py-2">1</td>
                <td class="px-4 py-2">100.00 €</td>
                <td class="px-4 py-2">100.00 €</td>
            </tr>
            <!-- Ajouter plus de produits ici -->
            </tbody>
        </table>
    </div>

    <!-- Bouton retour -->
    <div class="mt-6">
        <a href="/orders" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-300">
            Retour à la liste des commandes
        </a>
    </div>
</div>
<?php else : ?>
    <p class="mt-8 text-center text-gray-500">Aucune commande trouvée.</p>
<?php endif; ?>

