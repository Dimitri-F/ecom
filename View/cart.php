<?php if (!empty($products)) : ?>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl text-center font-bold mb-4">Votre Panier</h2>
        <!-- Conteneur défilable pour le tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 hidden lg:table">
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
                                <!-- Bouton "-" -->
                                <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST">
                                    <input type="hidden" name="action" value="decrement">
                                    <button type="submit" class="btn btn-secondary px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">-</button>
                                </form>
                                <span class="font-medium"><?= htmlspecialchars($product['quantity']) ?></span>
                                <!-- Bouton "+" -->
                                <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST">
                                    <input type="hidden" name="action" value="increment">
                                    <button type="submit" class="btn btn-secondary px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="py-2 px-4"><?= htmlspecialchars($product['price']) ?> €</td>
                        <td class="py-2 px-4"><?= htmlspecialchars($product['price'] * $product['quantity']) ?> €</td>
                        <td class="py-2 px-4">
                            <a href="/cart_remove/<?= htmlspecialchars($product['id']) ?>" class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600 transition duration-300">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Design alternatif pour petits écrans -->
            <div class="lg:hidden">
                <?php foreach ($products as $product) : ?>
                    <div class="border-b p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-bold"><?= htmlspecialchars($product['name']) ?></p>
                                <p class="text-sm text-gray-600">Prix Unitaire : <?= htmlspecialchars($product['price']) ?> €</p>
                                <p class="text-sm text-gray-600">Sous-total : <?= htmlspecialchars($product['price'] * $product['quantity']) ?> €</p>
                            </div>
                            <div>
                                <a href="/cart_remove/<?= htmlspecialchars($product['id']) ?>" class="inline-block rounded-md bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">Supprimer</a>
                            </div>
                        </div>
                        <div class="flex items-center mt-2 space-x-2">
                            <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST">
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit" class="px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">-</button>
                            </form>
                            <span class="font-medium"><?= htmlspecialchars($product['quantity']) ?></span>
                            <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST">
                                <input type="hidden" name="action" value="increment">
                                <button type="submit" class="px-2 py-1 rounded bg-gray-200 hover:bg-gray-300">+</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-lg text-right font-bold">Total : <?= isset($totalAmount) ? htmlspecialchars($totalAmount) : '0' ?> €</p>
            <p class="mt-2"><a href="/cart_clear" class="inline-block rounded-md bg-orange-500 px-4 py-2 text-sm text-white hover:bg-orange-600">Vider le panier</a></p>
        </div>
        <div class="mt-6 text-center">
            <a href="/pay" class="inline-block rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Procéder à l'achat</a>
        </div>
    </div>
<?php else : ?>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
        <p class="text-lg text-center">Votre panier est vide.</p>
    </div>
<?php endif; ?>

<div class="m-6">
    <a href="/products" class="bg-gray-500 text-white text-sm py-2 px-4 rounded hover:bg-gray-600">Retour à la liste d'articles</a>
</div>
