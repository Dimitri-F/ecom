<?php

global $stripeSecretKey;

use Db\Spdo;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

require '../vendor/autoload.php';
require_once '../config.php';

echo $_SESSION['userId'];

$stripe = new StripeClient($stripeSecretKey);

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_54e2c11c07e4b6e26c22113365c5efa492f764d84dd0963398561e45a0d86675';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch(SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object;
    // ... handle other event types
        $userId = $paymentIntent->user_id; // Récupérer l'utilisateur connecté (cela doit être implémenté selon votre logique)
        $stripePaymentId = $paymentIntent->id;
        $productIds = '1,2,3'; // Récupérer les IDs des produits dans le panier (à ajuster selon votre logique)
        $shippingAddress = '123 Rue Example, Paris, France'; // Adresse de livraison

        // Insertion dans la base de données
        $stmt = Spdo::getInstance()->prepare("INSERT INTO orders (user_id, stripe_payment_id, product_ids, shipping_address) VALUES (:user_id, :stripe_payment_id, :product_ids, :shipping_address)");
        $stmt->execute([
            ':user_id' => $userId,
            ':stripe_payment_id' => $stripePaymentId,
            ':product_ids' => $productIds,
            ':shipping_address' => $shippingAddress
        ]);

        break;
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);