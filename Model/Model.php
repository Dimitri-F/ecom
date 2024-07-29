<?php

namespace Model;

use Db\Spdo;
use PDO;

class Model
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

    public function deleteById(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


}