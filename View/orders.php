<?php ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Liste des commandes de <?php echo htmlspecialchars($_SESSION['userPseudo']); ?></h1>

    <?php if (!empty($orders)) : ?>
        <!-- Grille responsive -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($orders as $order) : ?>
                <!-- Liste de commandes -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:bg-gray-50 transition duration-300">
                    <h2 class="text-xl font-semibold mb-2">Commande #<?= htmlspecialchars($order['id']) ?></h2>
                    <p class="text-gray-600">Date : <?= htmlspecialchars($order['order_date']) ?></p>
                    <p class="text-gray-600">Total : <?= htmlspecialchars($order['amount']) ?> €</p>
                    <div class="mt-4">
                        <a href="/orders_detail/<?=$order['id']?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                            Voir les détails
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="mt-8 text-center text-gray-500">Aucune commande trouvée.</p>
    <?php endif; ?>
</div>



