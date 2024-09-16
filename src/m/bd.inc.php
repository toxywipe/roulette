<?php

class connexion_PDO {

    private $login = "root";
    private $mdp = "";
    private $bd = "roulette";
    private $serveur = "localhost";
    protected $CNX = null;

    public function __construct() {
        try {
            $this->CNX = new PDO("mysql:host=$this->serveur;dbname=$this->bd;charset=UTF8", $this->login, $this->mdp); 
            $this->CNX->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->CNX;

        } catch (PDOException $e) {
            print "Erreur de connexion PDO ";
            die();
        }
    }
}
?>