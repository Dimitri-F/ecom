<?php

namespace Database;

use PDO;
require '../config.php';

class Spdo
{
    /**
     * Instance de la classe SPDO
     *
     * @var SPDO
     * @access private
     */
    private ?PDO $PDOInstance = null;


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
    const DEFAULT_SQL_USER = USER;

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_HOST = HOST;

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_PASS = PASSWORD;

    /**
     * Constante: nom de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_DTB = DB_NAME;

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

    public function prepare(string $query)
    {
        return $this->PDOInstance->prepare($query);
    }

//    public function query(string $query)
//    {
//        return $this->PDOInstance->query($query);
//    }
}
