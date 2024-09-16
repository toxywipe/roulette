<?php

include_once 'src\m\bd.class.inc.php';

class ClassController {

    private $modelClass;

    public function __construct() {
        $this->modelClass = new modele_class();
    }

    // Afficher toutes les classes
    public function showClasses() {
        $classes = $this->modelClass->getAllClasses();
        // include 'v/class/list.php';  // Vue pour afficher la liste des classes
    }

    // Afficher les étudiants d'une classe
    public function showStudents($nameClass) {
        $studentController = new StudentController();  // Appeler StudentController
        $studentController->showStudentsByClass($nameClass);
    }

    // Ajouter une nouvelle classe
    public function addClass($nameClass) {
        // Vérifier si la classe existe déjà
        $class = $this->modelClass->getClassByName($nameClass);
        if (!$class) {
            // Si elle n'existe pas, l'ajouter
            $this->modelClass->addClass($nameClass);
            // Rediriger vers la liste des classes après ajout
            // header('Location: /class/show');
        } else {
            // Classe déjà existante, afficher un message d'erreur (tu peux personnaliser cela dans une vue)
            echo "La classe existe déjà !";
        }
    }

    // Supprimer une classe
    public function deleteClass($idClass) {
        // Supprimer la classe et rediriger vers la liste des classes
        $this->modelClass->deleteClass($idClass);
        // header('Location: /class/show');
    }
}
?>
