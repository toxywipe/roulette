<?php

include_once "bd.inc.php";


class modele_student {
    private $pdo;

    public function __construct() {
        $this->pdo = (new connexion_PDO())->getConnection();
    }

     //  Récupérer tous les étudiants
     public function getStudents() {
        try {
            $req = $this->pdo->prepare("SELECT * FROM student");
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des étudiants : " . $e->getMessage());
        }
    }

    //  Récupérer les étudiants par classe
    public function getStudentsByClass($idClass) {
        try {
            $req = $this->pdo->prepare("SELECT * FROM student WHERE idClass = :idClass");
            $req->bindValue(':idClass', $idClass, PDO::PARAM_INT);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des étudiants par classe : " . $e->getMessage());
        }
    }

    public function addStudent($firstname, $surname, $idClass) {
        try {
            $req = $this->pdo->prepare("INSERT INTO student (firstname, surname, idClass) VALUES (:firstname, :surname, :idClass)");
            $req->bindValue(':firstname', htmlspecialchars($firstname), PDO::PARAM_STR);
            $req->bindValue(':surname', htmlspecialchars($surname), PDO::PARAM_STR);
            $req->bindValue(':idClass', $idClass, PDO::PARAM_INT);
            return $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de l'étudiant : " . $e->getMessage());
        }
    }

    public function deleteStudent($idStudent) {
        try {
            $req = $this->pdo->prepare("DELETE FROM student WHERE id = :idStudent");
            $req->bindValue(':idStudent', $idStudent, PDO::PARAM_INT);
            return $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de l'étudiant : " . $e->getMessage());
        }
    }

    /*         Obtionnel         */

    // Ajoute une note sans écraser les précédentes
    // - `COALESCE()` évite les erreurs si la valeur est NULL (la remplace par zero ici)
    // - Cumule les notes et met à jour la moyenne
    // - Incrémente `notetotal` pour suivre le nombre de notes

    public function assignNote($idStudent, $note) {
        try {
            $req = $this->pdo->prepare("
                UPDATE student 
                SET noteaddition = COALESCE(noteaddition, 0) + :note, 
                    notetotal = COALESCE(notetotal, 0) + 1, 
                    average = (COALESCE(noteaddition, 0) + :note) / (COALESCE(notetotal, 0) + 1)
                WHERE id = :idStudent
            ");
            
            $req->bindValue(':idStudent', $idStudent, PDO::PARAM_INT);
            $req->bindValue(':note', $note, PDO::PARAM_STR);
            $req->execute();
            
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'attribution de la note : " . $e->getMessage());
        }
    }
    

    // Fonction pour marquer un étudiant comme absent
    public function markStudentAbsent($studentId) {
        try {
            $sql = "UPDATE student SET absence = 1 WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
            $stmt->execute();
            return true; // Succès
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'absence : " . $e->getMessage();
            return false; // Échec
        }
    }

    // Réinitialiser les passages pour une classe
    public function resetPassages($nameClass) {
        try {
            $req = $this->pdo->prepare("UPDATE student SET passage = 0 WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur !: " . $e->getMessage());
        }
    }

    // Réinitialiser les passages et les notes pour une classe
    public function resetAll($nameClass) {
        try {
            $req = $this->pdo->prepare("UPDATE student SET passage = 0, noteaddition = NULL WHERE nameClass = :nameClass");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur !: " . $e->getMessage());
        }
    }

    // Récupérer les étudiants déjà passés
    public function getPassedStudents($nameClass) {
        $resultat = array();

        try {
            $req = $this->pdo->prepare("SELECT * FROM student WHERE nameClass = :nameClass AND passage = 1");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur !: " . $e->getMessage());
        }
        return $resultat;
    }

    // Récupérer les étudiants restants (ceux qui n'ont pas encore été tirés au sort)
    public function getRemainingStudents($nameClass) {
        $resultat = array();

        try {
            $req = $this->pdo->prepare("SELECT * FROM student WHERE nameClass = :nameClass AND passage = 0");
            $req->bindValue(':nameClass', $nameClass, PDO::PARAM_STR);
            $req->execute();

            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur !: " . $e->getMessage());
        }
        return $resultat;
    }

    // Sélectionner un étudiant aléatoirement dans une classe
    public function drawStudent($classeChoisie) {
        try {
            // ✅ Vérifier si la classe sélectionnée est valide
            if (!$classeChoisie) {
                throw new Exception("Aucune classe sélectionnée.");
            }
    
            // ✅ Requête SQL : Sélectionne un étudiant aléatoirement dans la classe choisie
            $sql = "SELECT * FROM student WHERE idClass = :classeChoisie ORDER BY RAND() LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':classeChoisie', $classeChoisie, PDO::PARAM_INT);
            $stmt->execute();
    
            // ✅ Récupérer l’étudiant s’il existe
            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$etudiant) {
                throw new Exception("Aucun étudiant trouvé pour cette classe.");
            }
    
            return $etudiant;
        } catch (Exception $e) {
            // ✅ Gérer les erreurs et les stocker en session
            $_SESSION['error'] = $e->getMessage();
            return null;
        }
    }    

}
?>
