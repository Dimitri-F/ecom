<?php ?>

<h1>ADMIN : Liste des commandes</h1>

        <table id="ordersTable" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Id Utilisateur</th>
                <th>Liste des produits</th>
                <th>Montant total</th>
                <th>Adresse</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($orders)) {
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['user_id']) ?></td>

                        <!-- Afficher les détails des produits -->
                        <td>
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

                        <td><?= htmlspecialchars($order['amount']) ?> €</td>
                        <td><?= htmlspecialchars($order['street']) . ', ' . htmlspecialchars($order['postal_code']) . ', ' . htmlspecialchars($order['city']) . ', ' . htmlspecialchars($order['country']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                    </tr>
                <?php endforeach;
            } ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                $('#ordersTable').DataTable({
                });
            });
        </script>