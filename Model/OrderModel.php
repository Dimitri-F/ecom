<?php

namespace Model;

use PDOException;

class OrderModel extends BaseModel
{
    protected string $table = 'orders';

    public function getByUserId($userId)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return [];
        }
    }
}