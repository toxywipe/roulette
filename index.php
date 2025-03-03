<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//  Inclure la configuration globale
include_once "src/m/bd.inc.php";
include_once "src/c/controller.php";

//  Récupérer l'action demandée (ou accueil par défaut)
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "accueil";

//  Exécuter le contrôleur principal pour rediriger vers la bonne page
include "src/c/controller.php";
?>