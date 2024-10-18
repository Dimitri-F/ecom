<?php

namespace Model;

class OrderModel extends BaseModel
{
    protected string $table = 'orders';

    public function getByUserId($userId)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");

        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}