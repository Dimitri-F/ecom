<?php

namespace Model;

use Database\Spdo;
use PDO;
use PDOException;

class BaseModel
{
    protected ?Spdo $pdo;
    protected string $table;
    public function __construct()
    {
        $this->pdo = Spdo::getInstance();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByID(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result === false) {
            return [];
        }

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Insère une nouvelle ligne dans la table spécifiée avec les données fournies.
     *
     * Cette méthode génère dynamiquement la requête SQL basée sur les colonnes
     * et leurs valeurs dans le tableau $data. Elle lie ensuite chaque valeur
     * de manière appropriée et exécute la requête d'insertion.
     *
     * @param array $data Un tableau associatif contenant les colonnes et leurs valeurs.
     *                    Exemple : ['category_id' => 2, 'name' => 'New Product', 'price' => 99.99]
     *
     * @return bool Retourne true si l'insertion a réussi, sinon false.
     *
     * @throws PDOException Si une erreur survient lors de la préparation ou de l'exécution de la requête.
     */
    public function create(array $data): bool {
        // Préparer les parties INSERT INTO et VALUES de la requête SQL
        $columns = array_keys($data);
        $columnsList = implode(", ", $columns);
        $placeholders = implode(", ", array_map(fn($column) => ":$column", $columns));

        // Préparer la requête SQL
        $sql = "INSERT INTO {$this->table} ($columnsList) VALUES ($placeholders)";

        try {
            // Préparer la requête
            $stmt = $this->pdo->prepare($sql);

            // Lier les paramètres dynamiquement
            foreach ($data as $column => $value) {
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(":$column", $value, $paramType);
            }

            // Exécuter la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            // Gérer les exceptions et enregistrer l'erreur
            echo "Erreur lors de la création : " . $e->getMessage();
            return false;
        }
    }


    /**
     * Met à jour une ligne dans la table spécifiée avec les données fournies.
     *
     * Cette méthode génère dynamiquement la requête SQL basée sur les colonnes
     * et leurs valeurs dans le tableau $data. Elle lie ensuite chaque valeur
     * de manière appropriée et exécute la requête de mise à jour.
     *
     * @param int   $id   L'ID de la ligne à mettre à jour.
     * @param array $data Un tableau associatif contenant les colonnes et leurs nouvelles valeurs.
     *                    Exemple : ['category_id' => 2, 'name' => 'New Name', 'price' => 99.99]
     *
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     *
     * @throws PDOException Si une erreur survient lors de la préparation ou de l'exécution de la requête.
     */
    public function update(int $id, array $data): bool {
        // Préparer les parties SET de la requête SQL
        $columns = array_keys($data);
        $setClause = implode(", ", array_map(fn($column) => "$column = :$column", $columns));

        // Préparer la requête SQL
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";

        try {
            // Préparer la requête
            $stmt = $this->pdo->prepare($sql);

            // Lier les paramètres dynamiquement
            foreach ($data as $column => $value) {
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(":$column", $value, $paramType);
            }

            // Lier l'ID
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Exécuter la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            // Gérer les exceptions et enregistrer l'erreur
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }



}