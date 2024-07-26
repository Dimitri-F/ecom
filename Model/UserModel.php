<?php

namespace Model;

use PDO;

class UserModel extends Model
{
    protected string $table = 'users';

    public function insert(string $pseudo, string $password): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (pseudo, password, admin) VALUES (:pseudo, :password, :admin)");

        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $admin = 0;
        $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function recoverUserId(string $pseudo, string $password): ?int
    {
        $stmt = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = :pseudo AND password = :password");

        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? (int) $result['id'] : null;
    }

    public function recoverUser(string $pseudo): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE pseudo = :pseudo");

        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : null;
    }


}