<?php

namespace Controller;

use Exception;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Webhook;

class PaymentController
{
    private string $clientSecret;
    private string $webhookSecret;

    private ProductController $productController;

    private OrderController $orderController;

    private CartController $cartController;

    public function __construct(string $clientSecret, string $webhookSecret = '')
    {
        $this->clientSecret = $clientSecret;
        $this->webhookSecret = $webhookSecret;
        Stripe::setApiKey($this->clientSecret);
        Stripe::setApiVersion('2023-10-16');
        $this->productController = new ProductController();
        $this->orderController = new OrderController();
        $this->cartController = new CartController();
    }

    public function createPayment(){
        $cart = $_SESSION['cart'] ?? [];
        $userId = $_SESSION['userId'] ?? null;
        define("DOMAIN", 'http://ecom');

        if (empty($cart)) {
            // Gérer le cas où le panier est vide (rediriger, afficher un message, etc.)
            die("Votre panier est vide.");
        }

        if (empty($userId)) {
            header("Location: /login" );
        }

        // Construire une liste des IDs de produits à partir du panier
        $productIds = array_keys($cart);

        if (empty($productIds)) {
            die("Aucun produit trouvé dans votre panier.");
        }

        // Récupérer les détails des produits depuis la BDD
        $products = $this->productController->getProductDetails($productIds);

        //Stocker les noms des produits
        $productsNames = array_column($products, 'name');

        // Convertir les noms des produits en chaîne de caractères
        $productsNamesStr = implode(', ', $productsNames);

        // Construire les éléments de ligne pour Stripe
        $lineItems = array_map(function ($product) use ($cart) {
            $quantity = $cart[$product['id']];
            if ($quantity <= 0) {
                throw new Exception('Quantité invalide pour le produit ' . $product['name']);
            }
            return [
                'quantity' => $quantity,
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $product['name'],
                        'description' => $product['description']
                    ],
                    'unit_amount' => intval(round($product['price'] * 100)) // Prix en centimes
                ]
            ];
        }, $products);

        try {
            $checkout_session = Session::create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => DOMAIN . '/success',
                'cancel_url' => DOMAIN . '/cancel',
                'billing_address_collection' => 'required',
                'shipping_address_collection' => [
                    'allowed_countries' => ['FR']
                ],
                'metadata' => [
                    'user_id' => $userId,
                    'products'=> $productsNamesStr
                ]
            ]);

            header("HTTP/1.1 303 See Other");
            header("Location: " . $checkout_session->url);
        } catch (\Exception $e) {
            echo "Erreur lors de la création de la session de paiement : " . $e->getMessage();
        }

    }

    public function handle($payload, $sigHeader){

        try {
            // On vérifie la signature et on construit l'évènement
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $this->webhookSecret
            );
        } catch (UnexpectedValueException $e) {
            // Charge utile (Payload) invalide
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            // Signature Stripe invalide
            http_response_code(400);
            exit();
        }

        // En fonction de l'évènement reçu par le webhook
        if ($event->type === 'checkout.session.completed'){
            // Gérez la session de paiement terminée
            $data = $event->data['object'];
            $client = new StripeClient($this->clientSecret);
            $stripeSessionId = $data['id'];

            // Récupérer les détails de la session
            $sessionStripe = $client->checkout->sessions->retrieve($stripeSessionId, []);

            // Accéder à l'adresse de livraison
            $shippingDetails = $sessionStripe->shipping_details->address ?? null;

            //Récupérer l'id de l'utilisateur
            $userId = $sessionStripe->metadata->user_id;

            //Récupérer les produits de la commande
            $productsLines =  $sessionStripe->metadata->products;

            // Récupérer le montant total de la session (en cents)
            $amountCent = $sessionStripe->amount_total;

            // Conversion du prix
            $amount = $amountCent / 100;

            if ($shippingDetails) {
                $streetLine1 = $shippingDetails->line1; // Récupère la première ligne de la rue
                $streetLine2 = $shippingDetails->line2; // Récupère la deuxième ligne
                $city = $shippingDetails->city; // Récupère la ville
                $country = $shippingDetails->country; // Récupère le pays
                $postalCode = $shippingDetails->postal_code; // Récupère le code postal

                // Vérification si la deuxième ligne de l'adresse est renseignée
                if ($streetLine2 !== null) {
                    // concaténer avec la première ligne
                    $fullStreet = $streetLine1 . ", " . $streetLine2;
                } else {
                    // Utiliser uniquement la première ligne
                    $fullStreet = $streetLine1;
                }

                $this->orderController->createOrder($userId, $fullStreet, $postalCode, $city, $country, $productsLines, $amount);
            }

        }

    }

}