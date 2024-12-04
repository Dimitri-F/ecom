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

    public function removeProduct(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
    }

    public function clearCart(): void
    {
        $_SESSION['cart'] = [];
    }

    public function getProductById(int $productId): array
    {
        return $this->productModel->getByID($productId);
    }
}
