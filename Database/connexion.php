<?php
// Charger les variables d'environnement depuis le fichier .env
require_once dirname(__DIR__ . '/../vendor/autoload.php');
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../ecom/');
$dotenv->load();


$servername = $_ENV['SERVER'];
$username = $_ENV['USER'];
$password = $_ENV['PASSWORD'];


try {
    // On établit la connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=bddtest", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie';
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

