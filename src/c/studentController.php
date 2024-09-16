<?php

include_once 'src\m\bd.student.inc.php';

class StudentController {

    private $modelStudent;

    public function __construct() {
        $this->modelStudent = new modele_student();
    }

    // Afficher les étudiants d'une classe
    public function showStudentsByClass($nameClass) {
        $students = $this->modelStudent->getStudentsByClass($nameClass);
        include 'v/student/list.php';  // Vue pour afficher les étudiants d'une classe
    }

    // Tirer un étudiant au sort
    public function drawStudent($nameClass) {
        $student = $this->modelStudent->drawStudent($nameClass);
        include 'v/student/draw.php';  // Vue pour afficher l'étudiant tiré au sort
    }

    // Affecter une note à un étudiant
    public function setGrade($studentId, $grade) {
        $this->modelStudent->setStudentGrade($studentId, $grade);
        // Redirection après l'affectation de la note
        header('Location: /student/show?nameClass=' . $_GET['nameClass']);
    }

    // Réinitialiser les passages d'une classe
    public function resetPassages($nameClass) {
        $this->modelStudent->resetPassages($nameClass);
        // Redirection après la réinitialisation
        header('Location: /student/show?nameClass=' . $nameClass);
    }

    // Réinitialiser les passages et les notes d'une classe
    public function resetAll($nameClass) {
        $this->modelStudent->resetAll($nameClass);
        // Redirection après la réinitialisation
        header('Location: /student/show?nameClass=' . $nameClass);
    }
}
?>
