<?php ?>
<!-- component -->
<div class="m-5">
    <a class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-300" href="/products">Retour à la liste d'articles</a>
</div>

<?php if (!empty($product)) : ?>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 m-2">
        <div class="flex font-sans bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="flex-none w-96 relative"> <!-- Agrandi ici -->
                <img src="/uploads/<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy" />
            </div>
            <form class="flex-auto p-6" method="POST" action="/cart_add/<?=$product['id']?>">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">
                        <?= htmlspecialchars($product['name']); ?>
                    </h1>
                    <div class="text-xl font-semibold text-gray-800 mb-4">
                        <?= htmlspecialchars($product['price']); ?> €
                    </div>
                    <div class="text-sm text-gray-600 mb-4">
                        <?= htmlspecialchars($product['description']); ?>
                    </div>
                    <div class="text-sm font-medium text-gray-700 mb-4">
                        Statut: <span class="text-green-500">Disponible</span>
                    </div>
                </div>

                <div class="flex space-x-4 mb-6">
                    <div class="flex-auto flex space-x-2 items-center">
                        <label for="quantity" class="text-sm font-medium text-gray-700">Quantité:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="h-10 w-16 text-center border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-600">
                        <button type="submit" class="h-10 px-6 font-semibold rounded-md bg-indigo-600 text-white transition duration-200 hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-500">
                    Livraison gratuite
                </p>
            </form>
        </div>
    </div>


<?php else : ?>
    <p class="mt-8 text-center text-gray-500">Aucun article trouvé.</p>
<?php endif; ?>