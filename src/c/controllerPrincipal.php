<?php

class controleurPrincipal {
    public static function getAction($action){
        $lesActions = array(
            "defaut" => "accueil.php",
        );
        return isset($lesActions[$action]) ? $lesActions[$action] : $lesActions["defaut"];
    }
}

?>
