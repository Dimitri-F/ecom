<?php

namespace Controller;

use Model\OrderModel;
use Src\Renderer;

class OrderController
{
    private OrderModel $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function createOrder(int $userId, string $fulladdress, string $postalCode, string $city, string $country, string $products, float $amount){

        // Créer l'array $data
        $data = [
            'user_id' => $userId,
            'street' => $fulladdress,
            'postal_code' => $postalCode,
            'city' => $city,
            'country' => $country,
            'products' => $products,
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

        return $this->orderModel->getByID($id);
    }

    public function getOrderByUserId($userId): array
    {
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

        return Renderer::make('orders_detail', ['order' => $order]);
    }
}