<?php

namespace Model;


use PDO;
use PDOException;

class ProductModel extends BaseModel
{
    protected string $table = 'products';

    public function getProductPhoto(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT photo FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['photo'])) {
            return $result['photo'];
        } else {
            return null;
        }
    }

}

