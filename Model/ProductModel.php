<?php

namespace Model;


use PDO;
use PDOException;

class ProductModel extends Model
{
    protected string $table = 'products';

    public function getProductPhoto(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT photo FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['photo'])) {
            return $result['photo'];
        } else {
            return null;
        }

    }

    public function update(int $id, int $categoryId, string $name, string $description, float $price, ?string $photoPath): bool
    {
        // Préparer la requête SQL avec les colonnes spécifiques
        $sql = "UPDATE products 
            SET category_id = :category_id, 
                name = :name, 
                description = :description, 
                price = :price, 
                photo = :photo 
            WHERE id = :id";

        try {
            // Préparer la requête
            $stmt = $this->pdo->prepare($sql);

            // Lier les paramètres
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photoPath);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécuter la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            // Gérer les exceptions et enregistrer l'erreur
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }


}

