<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

// Inclusions des modèles
include_once "src\m\bd.student.inc.php";
include_once "src\m\bd.class.inc.php";

// Récupération des données GET ou POST
$nameClass = isset($_GET["nameClass"]) ? $_GET["nameClass"] : '';

// Création des objets modèles pour récupérer les données
$STUDENT = new modele_student();

// Récupérer la liste des étudiants de la classe spécifiée
$students = $STUDENT->getStudentsByClass($nameClass);

// Appel des vues pour l'affichage des données
$titre = "Liste des étudiants de la classe $nameClass";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueListeEtudiants.php";
include "$racine/vue/pied.html.php";
?>
