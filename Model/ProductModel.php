<?php

namespace Model;

use PDO;

class ProductModel extends BaseModel
{
    protected string $table = 'products';

    public function retrieveProductsByIds(string $placeholders, $ids) : array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

