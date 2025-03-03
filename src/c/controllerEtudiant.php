<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "m/bd.student.inc.php";

$STUDENT = new modele_student();

//  Ajouter un étudiant
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ajouterEtudiant'])) {
    $firstname = trim($_POST['firstname']);
    $surname = trim($_POST['surname']);
    $idClass = intval($_POST['idClass']);

    if (!empty($firstname) && !empty($surname) && $idClass > 0) {
        if ($STUDENT->addStudent($firstname, $surname, $idClass)) {
            $_SESSION['message'] = "Étudiant ajouté avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout de l'étudiant.";
        }
    } else {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
    }
}

//  Supprimer un étudiant
if (isset($_GET['supprimerEtudiant'])) {
    $idStudent = intval($_GET['supprimerEtudiant']);

    if ($STUDENT->deleteStudent($idStudent)) {
        $_SESSION['message'] = "Étudiant supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression de l'étudiant.";
    }
}

//  Redirection vers l'accueil après traitement
header("Location: v/accueil.php");
exit();
?>
