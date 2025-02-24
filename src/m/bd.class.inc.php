<?php

include_once "bd.inc.php";

class modele_class extends connexion_PDO {

    // Récupérer toutes les classes
    public function getAllClasses() {
        $resultat = array();

        try {
            $req = $this->CNX->prepare("SELECT * FROM class");
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Ajouter une nouvelle classe
    public function addClass($nameClass) {
        try {
            $req = $this->CNX->prepare("INSERT INTO class (nameClass) VALUES (:nameClass)");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    // Supprimer une classe (et les étudiants associés via ON DELETE CASCADE) 
    // public function deleteClass($idClass) {
    //     try {
    //         $req = $this->CNX->prepare("DELETE FROM class WHERE idClass = :idClass");
    //         $req->bindValue(':idClass', $idClass, PDO::PARAM_INT);
    //         $req->execute();
    //     } catch (PDOException $e) {
    //         print "Erreur !: " . $e->getMessage();
    //         die();
    //     }
    // }

    // Récupérer une classe par son nom
    public function getClassByName($nameClass) {
        $resultat = null;

        try {
            $req = $this->CNX->prepare("SELECT * FROM class WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}
?>
