<?php

include_once "bd.inc.php";


class modele_history {
    private $pdo;

    public function __construct() {
        $this->pdo = (new connexion_PDO())->getConnection();
    }

    public function saveTirage($idStudent, $firstname, $surname) {
        try {
            $req = $this->pdo->prepare("
                INSERT INTO tirage_history (idStudent, firstname, surname)
                VALUES (:idStudent, :firstname, :surname)
            ");
            $req->bindValue(':idStudent', $idStudent, PDO::PARAM_INT);
            $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $req->bindValue(':surname', $surname, PDO::PARAM_STR);
            return $req->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'enregistrement du tirage : " . $e->getMessage());
        }
    }   

    // Mettre à jour la dernière entrée dans history pour un étudiant
    public function updateHistory($studentId, $note, $absent) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE history 
                SET note = :note, absent = :absent 
                WHERE id_student = :studentId 
                ORDER BY id DESC 
                LIMIT 1
            ");
            return $stmt->execute([
                'note' => $note,
                'absent' => $absent,
                'studentId' => $studentId
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour de l'historique : " . $e->getMessage());
        }
    }

    public function getHistory() {
        $req = $this->pdo->prepare("SELECT * FROM tirage_history ORDER BY dateTirage DESC");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resetHistory() {
        $req = $this->pdo->prepare("DELETE FROM tirage_history");
        $req->execute();
    }

}