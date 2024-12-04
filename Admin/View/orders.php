<?php ?>

<h1 class="text-center text-2xl text-orange-500 font-bold m-4">ADMIN : Liste des commandes</h1>


<!-- Conteneur principal -->
<div class="overflow-x-auto">
    <table id="ordersTable" class="hidden lg:table min-w-full bg-white border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="py-3 px-4 text-left">Id Commande</th>
            <th class="py-3 px-4 text-left">Id Utilisateur</th>
            <th class="py-3 px-4 text-left">Liste des produits</th>
            <th class="py-3 px-4 text-left">Montant total</th>
            <th class="py-3 px-4 text-left">Adresse</th>
            <th class="py-3 px-4 text-left">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($orders)) {
            foreach ($orders as $order): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4"><?= htmlspecialchars($order['id']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($order['user_id']) ?></td>
                    <td class="py-2 px-4">
                        <?php
                        if (!empty($order['products'])) {
                            foreach ($order['products'] as $product) {
                                echo "<strong>Nom:</strong> " . htmlspecialchars($product['name']) . "<br>";
                                echo "<strong>Prix:</strong> " . htmlspecialchars($product['price']) . " €<br>";
                                echo "<strong>Quantité:</strong> " . htmlspecialchars($product['quantity']) . "<br><br>";
                            }
                        } else {
                            echo "Aucun produit";
                        }
                        ?>
                    </td>
                    <td class="py-2 px-4"><?= htmlspecialchars($order['amount']) ?> €</td>
                    <td class="py-2 px-4"><?= htmlspecialchars($order['street']) . ', ' . htmlspecialchars($order['postal_code']) . ', ' . htmlspecialchars($order['city']) . ', ' . htmlspecialchars($order['country']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($order['order_date']) ?></td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
    </table>

    <!-- Version empilée pour petits écrans -->
    <div class="lg:hidden">
        <?php if (isset($orders)) {
            foreach ($orders as $order): ?>
                <div class="border-b p-4">
                    <!-- ID et Utilisateur -->
                    <p class="text-sm text-gray-600"><strong>Id Commande :</strong> <?= htmlspecialchars($order['id']) ?></p>
                    <p class="text-sm text-gray-600"><strong>Id Utilisateur :</strong> <?= htmlspecialchars($order['user_id']) ?></p>

                    <!-- Liste des produits -->
                    <div class="my-4">
                        <strong class="text-sm text-gray-700">Liste des produits :</strong>
                        <div class="pl-4">
                            <?php
                            if (!empty($order['products'])) {
                                foreach ($order['products'] as $product) {
                                    echo "<p class='text-sm text-gray-600'><strong>Nom:</strong> " . htmlspecialchars($product['name']) . "</p>";
                                    echo "<p class='text-sm text-gray-600'><strong>Prix:</strong> " . htmlspecialchars($product['price']) . " €</p>";
                                    echo "<p class='text-sm text-gray-600'><strong>Quantité:</strong> " . htmlspecialchars($product['quantity']) . "</p>";
                                    echo "<hr class='my-2'>";
                                }
                            } else {
                                echo "<p class='text-sm text-gray-600'>Aucun produit</p>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Montant total -->
                    <p class="text-sm text-gray-600"><strong>Montant total :</strong> <?= htmlspecialchars($order['amount']) ?> €</p>

                    <!-- Adresse -->
                    <p class="text-sm text-gray-600"><strong>Adresse :</strong> <?= htmlspecialchars($order['street']) . ', ' . htmlspecialchars($order['postal_code']) . ', ' . htmlspecialchars($order['city']) . ', ' . htmlspecialchars($order['country']) ?></p>

                    <!-- Date -->
                    <p class="text-sm text-gray-600"><strong>Date :</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <?php endforeach;
        } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            responsive: true,
        });
    });
</script>
