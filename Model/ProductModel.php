<?php

namespace Model;

use PDO;
use PDOException;

class ProductModel extends BaseModel
{
    protected string $table = 'products';

    public function retrieveProductsByIds(string $placeholders, $ids) : array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return [];
        }
    }

}

