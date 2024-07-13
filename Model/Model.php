<?php

namespace Model;

use Db\Spdo;

class Model
{
    protected ?Spdo $pdo;
    public function __construct()
    {
        $this->pdo = Spdo::getInstance();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }
}