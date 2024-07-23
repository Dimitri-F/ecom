<?php

namespace Db;

use PDO;
use PDOStatement;

class Spdo
{
    /**
     * Instance de la classe SPDO
     *
     * @var SPDO
     * @access private
     */
    private null|PDO $PDOInstance = null;


    /**
     * Instance de la classe SPDO
     *
     * @var SPDO
     * @access private
     * @static
     */
    private static ?Spdo $instance = null;

    /**
     * Constante: nom d'utilisateur de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_USER = 'root';

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_HOST = 'localhost';

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_PASS = '';

    /**
     * Constante: nom de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_DTB = 'ecomm';

    /**
     * Constructeur
     *
     * @param void
     * @return void
     * @see PDO::__construct()
     */
    private function __construct()
    {
        $this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='
            .self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    /**
     * Crée et retourne l'objet SPDO
     *
     * @access Public
     * @static
     * @param void
     * @return SPDO $instance
     */
    public static function getInstance(): self
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Spdo();
        }
        return self::$instance;
    }

    /**
     * Exécute une requête SQL avec PDO
     *
     * @param string $query La requête SQL
     * @return PDOStatement Retourne l'objet PDOStatement
     */
    public function query(string $query): PDOStatement
    {
        return $this->PDOInstance->query($query);
    }

    public function prepare(string $query)
    {
        return $this->PDOInstance->prepare($query);
    }

    public function execute($query)
    {
        return $this->PDOInstance->execute($query);
    }

    /**
     * Lie un paramètre à une variable spécifique
     *
     * @param string $parameter Le nom du paramètre
     * @param mixed $variable La variable à lier
     * @param int|null $dataType Le type de la donnée
     * @return bool Retourne le résultat de l'opération
     */
    public function bindParam(string $parameter, mixed $variable, ?int $dataType = null): bool
    {
        return $this->PDOInstance->bindParam($parameter, $variable, $dataType);
    }
}
