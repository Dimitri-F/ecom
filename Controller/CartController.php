<?php

namespace Controller;

use Class\Renderer;
use Model\CartModel;

class CartController
{
    private CartModel $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

//    public function showCart(): Renderer
//    {
//        $cartItems = $this->cartModel->getCartItems();
//        $totalAmount = $this->cartModel->getTotalAmount();
//
//        return Renderer::make('cart', [
//            'cartItems' => $cartItems,
//            'totalAmount' => $totalAmount,
//        ]);
//    }

    public function showCart() {
//        // Récupération des produits dans le panier
//        $cartItems = $_SESSION['cart'] ?? [];
//        $products = [];
//        $totalAmount = 0;
//
//        foreach ($cartItems as $productId => $quantity) {
//            // Récupérer le produit par son ID
//            $product = $this->cartModel->getProductById($productId);
//            if ($product) {
//                $product['quantity'] = $quantity;
//                $product['subtotal'] = $product['price'] * $quantity;
//                $products[] = $product;
//                $totalAmount += $product['subtotal'];
//            }
//        }

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

//    public function addToCart(int $productId): void
//    {
//        $this->cartModel->addProduct($productId);
//        $_SESSION['message'] = "Nouveau produit ajouté au panier.";
//        header("Location: /products");
//        exit;
//    }

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

    public function showCheckout(): Renderer {
        if (!isset($_SESSION['userId'])) {
            $_SESSION['redirect_to'] = '/checkout'; // Stocker l'URL de redirection
            header("Location: /login"); // Rediriger vers la page de connexion
            exit;
        }

        return Renderer::make('checkout', []);
    }
}