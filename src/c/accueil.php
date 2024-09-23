<?php

// Inclusions des modèles
include_once "src/m/bd.student.inc.php";
include_once "src/m/bd.class.inc.php";

// Récupération des données GET ou POST
$nameClass = isset($_GET["nameClass"]) ? $_GET["nameClass"] : '';

// Création des objets modèles pour récupérer les données
$STUDENT = new modele_student();
$CLASS = new modele_class();

$AllStud = $STUDENT->getStudent();
$OneClass = $CLASS->getClassByName($nameClass);


// Appel des vues pour l'affichage des données
include_once "src/v/accueil.php";
?>
