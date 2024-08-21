<?php

global $stripeSecretKey;

use Db\Spdo;
use Stripe\Checkout\Session;
use Stripe\Stripe;

require_once '../vendor/autoload.php';
require_once '../config.php';

Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://ecom';

$cart = $_SESSION['cart'] ?? []; // Récupérer le panier depuis la session, ou un tableau vide si non défini
$userId = $_SESSION['userId'] ?? [];

if (empty($cart)) {
    // Gérer le cas où le panier est vide (rediriger, afficher un message, etc.)
    die("Votre panier est vide.");
}

// Construire une liste des IDs de produits à partir du panier
$productIds = array_keys($cart);

// Préparer une requête pour récupérer les détails des produits depuis la BDD
$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$query = Spdo::getInstance()->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$query->execute($productIds);
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Construire les éléments de ligne pour Stripe
$lineItems = array_map(fn($product) => [
    'quantity' => $cart[$product['id']], // Récupérer la quantité depuis le panier
    'price_data' => [
        'currency' => 'EUR',
        'product_data' => [
            'name' => $product['name'],
            'description' => $product['description']
        ],
        'unit_amount' => intval(round($product['price'] * 100)) // Prix en centimes
    ]
], $products);

$checkout_session = Session::create([
    'line_items' => $lineItems,
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success',
    'cancel_url' => $YOUR_DOMAIN . '/cancel',
    'billing_address_collection' => 'required',
    'shipping_address_collection' => [
        'allowed_countries' => ['FR']
    ],
    'metadata' => [
        'user_id' => 222
    ]
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);