<?php

namespace Model;
use Db\Spdo;

class ArticleModel
{

    private ?Spdo $pdo;
    private string $table = 'products';

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

