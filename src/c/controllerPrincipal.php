<?php

class ControleurPrincipal {
    private $lesActions;

    public function __construct() {
        $this->lesActions = array(
            "defaut" => "accueil.php"
        );
    }

    public function getAction($action) {
        // Vérification de l'existence de l'action dans la liste
        if (array_key_exists($action, $this->lesActions)) {
            return $this->lesActions[$action];
        } else {
            return $this->lesActions["defaut"];
        }
    }
}

?>
