<?php

namespace Model;

use PDO;

class UserModel extends BaseModel
{
    protected string $table = 'users';

    public function getUserId(string $pseudo): ?int
    {
        $stmt = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
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

    public function doesPseudoExist(string $pseudo): bool {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function isAdmin($userId): bool {
        $stmt = $this->pdo->prepare("SELECT admin FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result && $result['admin'] == 1;
    }

}