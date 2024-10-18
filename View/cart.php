<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?= htmlspecialchars($_SESSION['message']); ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h1>Votre panier</h1>

<?php if (!empty($products)) : ?>
    <table>
        <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Sous-total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>
                    <!-- Bouton "-" pour diminuer la quantité -->
                    <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="decrement">
                        <button type="submit" class="btn">-</button>
                    </form>

                    <?= htmlspecialchars($product['quantity']) ?>

                    <!-- Bouton "+" pour augmenter la quantité -->
                    <form action="/cart_update/<?= htmlspecialchars($product['id']) ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="increment">
                        <button type="submit" class="btn">+</button>
                    </form>
                </td>
                <td><?= htmlspecialchars($product['price']) ?> €</td>
                <td><?= htmlspecialchars($product['price'] * $product['quantity']) ?> €</td>
                <td>
                    <!-- Ajoute des actions comme modifier la quantité ou supprimer l'article -->
                    <a href="/cart_remove/<?= htmlspecialchars($product['id']) ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p><strong>Total : <?= isset($totalAmount) ? htmlspecialchars($totalAmount) : '0' ?> €</strong></p>
    <p><a href="/cart_clear">Vider le panier</a></p>
    <div>
        <a href="/pay" class="btn btn-primary">Procéder à l'achat</a>
    </div>
<?php else : ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>


