<?php

namespace Controller;

use Src\Renderer;
use Model\CartModel;

class CartController
{
    private CartModel $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    public function showCart() {
        $cartItems = $_SESSION['cart'] ?? [];
        $products = [];
        $totalAmount = 0;

        foreach ($cartItems as $productId => $quantity) {
            $product = $this->cartModel->getProductById($productId);
            if ($product) {
                $product['quantity'] = $quantity;
                $product['subtotal'] = $product['price'] * $quantity;
                $products[] = $product;
                $totalAmount += $product['subtotal'];
            }
        }

        // Passer les données à la vue avec Renderer::make
        return Renderer::make('cart', [
            'products' => $products,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function addToCart($productId) {
        // Récupérer la quantité de l'article depuis la requête POST
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        // Assure-toi que la quantité est au moins de 1
        if ($quantity < 1) {
            $quantity = 1;
        }

        // Récupérer le panier depuis la session
        $cart = $_SESSION['cart'] ?? [];

        // Si le produit est déjà dans le panier, on augmente la quantité
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            // Sinon, on ajoute le produit avec la quantité sélectionnée
            $cart[$productId] = $quantity;
        }

        // Mettre à jour la session
        $_SESSION['cart'] = $cart;
        // Rediriger l'utilisateur vers la page du panier ou une autre page appropriée
        header('Location: /cart');
        exit;
    }

    public function removeFromCart(int $productId): void
    {
        $this->cartModel->removeProduct($productId);
        $_SESSION['message'] = "Produit(s) retiré(s) du panier.";
        header("Location: /cart");
        exit;
    }

    public function updateCart($productId) {
        // Vérifier l'action à effectuer
        $action = $_POST['action'] ?? null;

        // Récupérer le panier depuis la session
        $cart = $_SESSION['cart'] ?? [];

        // Vérifier si le produit est dans le panier
        if (isset($cart[$productId])) {
            if ($action === 'increment') {
                // Augmenter la quantité du produit
                $cart[$productId]++;
            } elseif ($action === 'decrement') {
                // Diminuer la quantité du produit, mais pas en dessous de 1
                if ($cart[$productId] > 1) {
                    $cart[$productId]--;
                } else {
                    // Si la quantité est 1 et on appuie sur "-", on peut supprimer l'élément
                    unset($cart[$productId]);
                }
            }
        }

        // Mettre à jour le panier dans la session
        $_SESSION['cart'] = $cart;

        // Rediriger vers la page du panier
        header('Location: /cart');
        exit;
    }

    public function clearCart(): void
    {
        $this->cartModel->clearCart();
        $_SESSION['message'] = "Panier vidé.";
        header("Location: /cart");
        exit;
    }

    public function getCartProductsAsJson() {
        // Récupérer le panier depuis la session
        $cartItems = $_SESSION['cart'] ?? [];

        // Initialiser un tableau pour stocker les produits avec leurs informations
        $productsJson = [];

        // Initialiser un compteur pour nommer les produits dans le JSON
        $counter = 1;

        // Parcourir chaque produit dans le panier
        foreach ($cartItems as $productId => $quantity) {
            // Récupérer les détails du produit depuis le modèle
            $product = $this->cartModel->getProductById($productId);

            if ($product) {
                // Ajouter le produit dans le tableau JSON avec ses informations
                $productsJson["produit_$counter"] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'description' => $product['description'],
                    'quantity' => $quantity
                ];

                $counter++;
            }
        }

        // Convertir le tableau en JSON et le retourner
        return json_encode($productsJson);
    }

    public function showPayment(): Renderer
    {
        if (!isset($_SESSION['userId'])) {
            $_SESSION['redirect_to'] = '/pay'; // Stocker l'URL de redirection
            header("Location: /login"); // Rediriger vers la page de connexion
            exit;
        }

        return Renderer::make('pay', []);
    }

    public function showSuccess(): Renderer
    {
        return Renderer::make('success', []);
    }

    public function showCancel(): Renderer
    {
        return Renderer::make('cancel', []);
    }

}