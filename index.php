<?php

// Inclure le contrôleur
include 'src/c/controllerPrincipal.php';


if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "defaut";
 }

 $FICHIER = new controleurPrincipal();
 $fichier = $FICHIER->getAction($action);

 include "src/c/$fichier";

?>