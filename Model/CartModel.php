<?php

namespace Model;

class CartModel
{
    private ProductModel $productModel;

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->productModel = new ProductModel();
    }

    public function addProduct(int $productId, int $quantity = 1): void
    {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function removeProduct(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public function clearCart(): void
    {
        $_SESSION['cart'] = [];
    }

    public function getCartItems(): array
    {
        return $_SESSION['cart'];
    }

    public function getTotalAmount(): float
    {
        $total = 0;
        foreach ($this->getCartItems() as $productId => $quantity) {
            $product = $this->getProductById($productId); 
            $total += $product['price'] * $quantity;
        }

        return $total;
    }


    public function getProductById(int $productId): array
    {
        return $this->productModel->getByID($productId);
    }
}
