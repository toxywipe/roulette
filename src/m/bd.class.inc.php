<?php

include_once "bd.inc.php";

class modele_class {
    private $pdo;

    public function __construct() {
        $this->pdo = (new connexion_PDO())->getConnection();
    }

    //  Récupérer toutes les classes
    public function getAllClasses() {
        try {
            $req = $this->pdo->prepare("SELECT * FROM class");
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des classes : " . $e->getMessage());
        }
    }

    //  Ajouter une nouvelle classe
    public function addClass($nameClass) {
        try {
            $req = $this->pdo->prepare("INSERT INTO class (nameClass) VALUES (:nameClass)");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            return $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la classe : " . $e->getMessage());
        }
    }

    //  Supprimer une classe
    public function deleteClass($idClass) {
        try {
            $req = $this->pdo->prepare("DELETE FROM class WHERE idClass = :idClass");
            $req->bindValue(':idClass', $idClass, PDO::PARAM_INT);
            return $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la classe : " . $e->getMessage());
        }
    }
}

?>
