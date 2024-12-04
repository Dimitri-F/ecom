<?php

namespace Model;

use PDO;
use PDOException;

class UserModel extends BaseModel
{
    protected string $table = 'users';

    public function getUserId(string $pseudo): ?int
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int) $result['id'] : null;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return null;
        }
    }

    public function recoverUser(string $pseudo): ?array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return null;
        }
    }

    public function doesPseudoExist(string $pseudo): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE pseudo = :pseudo");
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return false;
        }
    }

    public function isAdmin($userId): bool
    {
        try {
            $stmt = $this->pdo->prepare("SELECT admin FROM {$this->table} WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result && $result['admin'] == 1;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return false;
        }
    }

    public function toggleAdminStatus(int $userId): void
    {
        // Vérifier le statut actuel de l'utilisateur
        $currentStatus = $this->isAdmin($userId);

        // Inverser le statut (si l'utilisateur est admin, le rendre non-admin et vice versa)
        $newStatus = $currentStatus ? 0 : 1;

        try {
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET admin = :admin WHERE id = :id");
            $stmt->bindParam(':admin', $newStatus, PDO::PARAM_INT);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}