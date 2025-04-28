<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "/../m/bd.class.inc.php";
include_once __DIR__ . "/../m/bd.student.inc.php";
include_once __DIR__ . "/../m/bd.history.inc.php";

$CLASS = new modele_class();
$STUDENT = new modele_student();
$HISTORY = new modele_history();

// Récupérer toutes les classes
$classes = $CLASS->getAllClasses();

$students = [];
if (isset($_SESSION['classeChoisie'])) {
    $students = $STUDENT->getStudentsByClass($_SESSION['classeChoisie']);
}

// Initialisation
$formType = $_POST['form_type'] ?? null;
$etudiantTirer = $_SESSION['etudiantTirer'] ?? null;

// Sélection de la classe
if ($formType === "select_class" && !empty($_POST['class'])) {
    $_SESSION['classeChoisie'] = intval($_POST['class']);
    $students = $STUDENT->getStudentsByClass($_SESSION['classeChoisie']);
    unset($_SESSION['etudiantTirer']); // Nouvelle classe, reset tirage
}

// Tirage d’un étudiant
if ($formType === "draw_student" && isset($_SESSION['classeChoisie'])) {
    if (!isset($_POST['idStudent']) && !isset($_POST['note'])) { 
        // => Sécurise : on vérifie que ce n'est PAS un post de notation ou d'absence
        $classeChoisie = $_SESSION['classeChoisie'];
        $etudiantTirer = $STUDENT->drawStudent($classeChoisie);

        if ($etudiantTirer) {
            if (!isset($_SESSION['dernier_tirage_id']) || $_SESSION['dernier_tirage_id'] !== $etudiantTirer['id']) {
                $HISTORY->saveTirage($etudiantTirer['id'], $etudiantTirer['firstname'], $etudiantTirer['surname']);
                $_SESSION['dernier_tirage_id'] = $etudiantTirer['id'];
            }
            $_SESSION['etudiantTirer'] = $etudiantTirer;
            $_SESSION['tirageEffectue'] = true;
        } else {
            $_SESSION['error'] = "Aucun étudiant disponible pour le tirage.";
        }
    }
}


// Attribution de note ou absence
if ($formType === "assign_grade" && isset($_POST['idStudent'])) {
    $studentId = intval($_POST['idStudent']);
    $note = $_POST['note'];

    if ($note === "absent") {
        $STUDENT->markStudentAbsent($studentId);
        $_SESSION['message'] = "L'étudiant a été marqué absent.";
    } else {
        $STUDENT->assignNote($studentId, intval($note));
        $_SESSION['message'] = "La note a été enregistrée.";
    }

    // Nettoyer toutes les traces du tirage
    unset($_SESSION['tirageEffectue']);
    unset($_SESSION['etudiantTirer']);
    unset($_SESSION['dernier_tirage_id']);
}

// Reset
if ($formType === "reset_passages") {
    $STUDENT->resetPassages($_SESSION['classeChoisie']);
    $_SESSION['message'] = "Les passages ont été réinitialisés.";
}
if ($formType === "reset_all") {
    $STUDENT->resetAll($_SESSION['classeChoisie']);
    $_SESSION['message'] = "Tout a été réinitialisé.";
}
if ($formType === "reset_notes") {
    $STUDENT->resetNotes();
    $_SESSION['message'] = "Toutes les notes ont été réinitialisées.";
}
if ($formType === "reset_history") {
    $HISTORY->resetHistory();
    $_SESSION['message'] = "L'historique des tirages a été réinitialisé.";
}

// Historique
$history = $HISTORY->getHistory();

// Messages
$message = $_SESSION['message'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['message'], $_SESSION['error']);

// Inclure la vue
include_once __DIR__ . "/../v/tirage.php";
?>
