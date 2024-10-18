<?php ?>

<h1>ADMIN : Liste des commandes</h1>

        <table id="ordersTable" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Id Utilisateur</th>
                <th>Liste des produits</th>
                <th>Montant</th>
                <th>Adresse</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($orders)) {

                foreach ($orders as $order): ?>

                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['user_id'] ?></td>
                        <td><?= $order['products'] ?></td>
                        <td><?= $order['amount'] ?></td>
                        <td><?= $order['street'] .', '. $order['postal_code'] .', '. $order['city'] .', '. $order['country'] ?></td>
                        <td><?= $order['order_date'] ?></td>
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