<?php

$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "accueil";

switch ($action) {
    case "accueil":
        include "controllerAccueil.php";
        break;
    case "tirage":
        include "controllerTirage.php"; 
        break;
    case "ajouterClasse":
        include "controllerClasse.php";
        break;
    case "ajouterEtudiant":
        include "controllerEtudiant.php";
        break;
    default:
        include "controllerErreur.php";
        break;
}

?>
