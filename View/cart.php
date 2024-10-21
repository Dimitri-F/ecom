<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?= htmlspecialchars($_SESSION['message']); ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>


<?php if (!empty($products)) : ?>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Votre Panier</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="py-3 px-4 text-left">Produit</th>
                <th class="py-3 px-4 text-left">Quantité</th>
                <th class="py-3 px-4 text-left">Prix Unitaire</th>
                <th class="py-3 px-4 text-left">Sous-total</th>
                <th class="py-3 px-4 text-left">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) : ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4"><?= htmlspecialchars($product['name']) ?></td>
                    <td class="py-2 px-4">
                        <div class="flex items-center space-x-2">
                            <!-- Bouton "-" pour diminuer la quantité -->
                            <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit" class="btn btn-secondary">-</button>
                            </form>

                            <span class="font-medium"><?= htmlspecialchars($product['quantity']) ?></span>

                            <!-- Bouton "+" pour augmenter la quantité -->
                            <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="increment">
                                <button type="submit" class="btn btn-secondary">+</button>
                            </form>
                        </div>
                    </td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['price']) ?> €</td>
                    <td class="py-2 px-4"><?= htmlspecialchars($product['price'] * $product['quantity']) ?> €</td>
                    <td class="py-2 px-4">
                        <!-- Ajoute des actions comme modifier la quantité ou supprimer l'article -->
                        <a href="/cart_remove/<?= htmlspecialchars($product['id']) ?>" class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm text-white shadow-sm focus:relative hover:bg-red-600 transition duration-300">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-4">
            <p class="text-lg font-bold"><strong>Total : <?= isset($totalAmount) ? htmlspecialchars($totalAmount) : '0' ?> €</strong></p>
            <p class="mt-2"><a href="/cart_clear" class="inline-block rounded-md bg-orange-500 px-4 py-2 text-sm text-white shadow-sm focus:relative hover:bg-orange-600 transition duration-300">Vider le panier</a></p>
        </div>
        <div class="mt-6 text-center">
            <a href="/pay" class="inline-block rounded-md bg-blue-500 px-4 py-2 text-white shadow-sm focus:relative hover:bg-blue-600 transition duration-300">Procéder à l'achat</a>
        </div>
    </div>
<?php else : ?>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <p class="text-lg">Votre panier est vide.</p>
    </div>
<?php endif; ?>
<div class="m-6">
    <a href="/products" class="bg-gray-500 text-white text-sm py-2 px-4 rounded hover:bg-gray-600 transition duration-300">Retour à la liste d'articles</a>
</div>




