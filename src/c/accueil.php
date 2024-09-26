<?php
// Démarrage de la session
session_start();

// Inclusions des modèles
include_once "src/m/bd.student.inc.php";
include_once "src/m/bd.class.inc.php";


// Création des objets modèles pour récupérer les données
$STUDENT = new modele_student();
$CLASS = new modele_class();

$AllStud = $STUDENT->getStudent();


if (isset($_POST['class'])) {
    $classeChoisie = $_POST['class'];
    $printClass = $STUDENT->getStudentsByClass($classeChoisie);
    $_SESSION['classeChoisie'] = $classeChoisie;
    $_SESSION['printClass'] = $printClass;
}


if (isset($_POST['tirer'])) {
    // Récupérer la classe choisie depuis la session
    $classeChoisie = isset($_SESSION['classeChoisie']) ? $_SESSION['classeChoisie'] : null;
    $printClass = isset($_SESSION['printClass']) ? $_SESSION['printClass'] : null;

    if (!empty($printClass)) {
        $etudiantTirer = $STUDENT->drawStudent($classeChoisie);
        $_SESSION['etudiantTirer'] = $etudiantTirer;
    }
}

// Récupérer l'étudiant tiré et la liste de la session pour l'afficher dans la vue
$SclassChoisie = isset($_SESSION['classeChoisie']) ? $_SESSION['classeChoisie'] : null;
$SprintClass = isset($_SESSION['printClass']) ? $_SESSION['printClass'] : null;
$SetudiantTirer = isset($_SESSION['etudiantTirer']) ? $_SESSION['etudiantTirer'] : null;


// Appel des vues pour l'affichage des données
include_once "src/v/accueil.php";
?>
