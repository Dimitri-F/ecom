<?php

namespace Controller;

use Model\CartModel;
use Model\OrderModel;
use Src\Renderer;

class OrderController
{
    private OrderModel $orderModel;
    private CartModel  $cartModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function createOrder(int $userId, string $fulladdress, string $postalCode, string $city, string $country, string $products, float $amount)
    {
        // Validation des entrées
        if (empty($userId) || empty($fulladdress) || empty($postalCode) || empty($city) || empty($country) || empty($products) || empty($amount)) {
            throw new \InvalidArgumentException('Tous les champs sont requis.');
        }

        // Créer l'array $data
        $data = [
            'user_id' => $userId,
            'street' => htmlspecialchars($fulladdress, ENT_QUOTES, 'UTF-8'),
            'postal_code' => htmlspecialchars($postalCode, ENT_QUOTES, 'UTF-8'),
            'city' => htmlspecialchars($city, ENT_QUOTES, 'UTF-8'),
            'country' => htmlspecialchars($country, ENT_QUOTES, 'UTF-8'),
            'products' => htmlspecialchars($products, ENT_QUOTES, 'UTF-8'),
            'amount' => $amount
        ];

        $this->orderModel->create($data);
    }

    public function getOrderList(): array
    {
        return $this->orderModel->getAll();
    }

    public function getOrderById($id): array
    {
        if (!filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            throw new \InvalidArgumentException('ID de commande invalide.');
        }

        return $this->orderModel->getByID($id);
    }

    public function getOrderByUserId($userId): array
    {
        if (!filter_var($userId, FILTER_VALIDATE_INT) || $userId <= 0) {
            throw new \InvalidArgumentException('ID utilisateur invalide.');
        }

        return $this->orderModel->getByUserId($userId);
    }

    public function showOrders(): Renderer
    {
        $userId = $_SESSION['userId'];
        $orders = $this->getOrderByUserId($userId);

        return Renderer::make('orders', ['orders' => $orders]);
    }

    public function showOrderDetail($id): Renderer
    {
        $order = $this->getOrderByID($id);

        // Décoder les produits JSON en tableau PHP
        $order['products'] = json_decode($order['products'], true);

        return Renderer::make('orders_detail', ['order' => $order]);
    }


}