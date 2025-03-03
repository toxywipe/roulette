<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "src/m/bd.class.inc.php";
include_once "src/m/bd.student.inc.php";

$CLASS = new modele_class();
$STUDENT = new modele_student();

$classes = $CLASS->getAllClasses();

// ✅ Inclure la vue accueil.php ici, pas dans controller.php
include_once "src/v/accueil.php";
?>

