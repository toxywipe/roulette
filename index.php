<?php

// Inclure le routeur et les contrôleurs
include 'src/c/controllerPrincipal.php';
include_once 'src/c/classController.php';
include_once 'src/c/studentController.php';


if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "defaut";
}

$FICHIER = new controleurPrincipal($action);
$fichier = $FICHIER->getAction($action);
include "src/v/$fichier";
?>



