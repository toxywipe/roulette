<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "src/m/bd.student.inc.php";

$STUDENT = new modele_student();

// ✅ Vérifier si une classe a été sélectionnée avant le tirage
if (!isset($_SESSION['classeChoisie'])) {
    $_SESSION['error'] = "Veuillez d'abord sélectionner une classe.";
    header("Location: index.php?action=accueil");
    exit();
}

$classeChoisie = $_SESSION['classeChoisie'];
$etudiantTirer = $STUDENT->drawStudent($classeChoisie);

// ✅ Vérifier si un étudiant a été trouvé
if ($etudiantTirer) {
    $_SESSION['etudiantTirer'] = $etudiantTirer;
} else {
    $_SESSION['error'] = "Aucun étudiant trouvé pour cette classe.";
}

// ✅ Vérifier si une note a été soumise
if (isset($_POST['note']) && isset($_SESSION['etudiantTirer'])) {
    $note = floatval($_POST['note']);

    if ($note >= 0 && $note <= 20) {
        $STUDENT->assignNote($_SESSION['etudiantTirer']['id'], $note);
        $_SESSION['message'] = "Note attribuée avec succès.";
    } else {
        $_SESSION['error'] = "Veuillez entrer une note valide entre 0 et 20.";
    }
}

include_once "src/v/tirage.php";
?>
