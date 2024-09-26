<?php

include_once "bd.inc.php";

class modele_student extends connexion_PDO {

    // Récupérer tous les étudiants
    public function getStudent() {
        $resultat = array();

        try {
            $req = $this->CNX->prepare("SELECT * FROM student");
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }


        return $resultat;
    }
    
    // Récupérer tous les étudiants d'une classe par son nom
    public function getStudentsByClass($nameClass) {
        $resultat = array();

        try {
            $req = $this->CNX->prepare("SELECT * FROM student WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Sélectionner un étudiant aléatoirement dans une classe
    public function drawStudent($nameClass) {
        $resultat = null;

        try {
            $req = $this->CNX->prepare("SELECT * FROM student WHERE nameClass = :nameClass AND absence = 0 ORDER BY RAND() LIMIT 1");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_INT);
            $req->execute();

            $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Affecter une note à un étudiant
    public function setStudentGrade($studentId, $grade) {
        try {
            $req = $this->CNX->prepare("UPDATE student SET noteaddition = :grade, passage = 1 WHERE id = :studentId");
            $req->bindValue(':grade', $grade, PDO::PARAM_INT);
            $req->bindValue(':studentId', $studentId, PDO::PARAM_INT);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    // Réinitialiser les passages pour une classe
    public function resetPassages($nameClass) {
        try {
            $req = $this->CNX->prepare("UPDATE student SET passage = 0 WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    // Réinitialiser les passages et les notes pour une classe
    public function resetAll($nameClass) {
        try {
            $req = $this->CNX->prepare("UPDATE student SET passage = 0, noteaddition = NULL WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    // Récupérer les étudiants déjà passés
    public function getPassedStudents($nameClass) {
        $resultat = array();

        try {
            $req = $this->CNX->prepare("SELECT * FROM student WHERE nameClass = :nameClass AND passage = 1");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    // Récupérer les étudiants restants (ceux qui n'ont pas encore été tirés au sort)
    public function getRemainingStudents($nameClass) {
        $resultat = array();

        try {
            $req = $this->CNX->prepare("SELECT * FROM student WHERE nameClass = :nameClass AND passage = 0");
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
