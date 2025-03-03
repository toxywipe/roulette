<?php

class connexion_PDO {
    private $login = "root";
    private $mdp = "";
    private $bd = "roulette";
    private $serveur = "localhost";
    protected static $CNX = null;

    public function __construct() {
        if (self::$CNX === null) {
            try {
                self::$CNX = new PDO("mysql:host=$this->serveur;dbname=$this->bd;charset=UTF8", $this->login, $this->mdp);
                self::$CNX->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
    }

    public function getConnection() {
        return self::$CNX;
    }
}

?>
