<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "m/bd.class.inc.php";

$CLASS = new modele_class();

//  Ajouter une classe
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ajouterClasse'])) {
    $nameClass = trim($_POST['nameClass']);

    if (!empty($nameClass)) {
        if ($CLASS->addClass($nameClass)) {
            $_SESSION['message'] = "Classe ajoutée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout de la classe.";
        }
    } else {
        $_SESSION['error'] = "Le nom de la classe ne peut pas être vide.";
    }
}

//  Supprimer une classe
if (isset($_GET['supprimerClasse'])) {
    $idClass = intval($_GET['supprimerClasse']);

    if ($CLASS->deleteClass($idClass)) {
        $_SESSION['message'] = "Classe supprimée avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression de la classe.";
    }
}

header("Location: v/accueil.php");
exit();
?>
