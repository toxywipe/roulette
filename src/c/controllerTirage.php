<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "/../m/bd.class.inc.php";
include_once __DIR__ . "/../m/bd.student.inc.php";

$CLASS = new modele_class();
$STUDENT = new modele_student();

// ✅ Récupérer toutes les classes
$classes = $CLASS->getAllClasses();

$students = [];

if (isset($_SESSION['classeChoisie'])) {
    $students = $STUDENT->getStudentsByClass($_SESSION['classeChoisie']);
}

// ✅ Vérifier quel formulaire a été soumis
$formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;

// ✅ Sélection de la classe
if ($formType === "select_class" && !empty($_POST['class'])) {
    $_SESSION['classeChoisie'] = intval($_POST['class']);
    
    // Recharge la liste d'étudiants apres selection de la classe
    $students = $STUDENT->getStudentsByClass($_SESSION['classeChoisie']);
}

// ✅ Tirage d’un étudiant
if ($formType === "draw_student" && isset($_SESSION['classeChoisie'])) {
    $classeChoisie = $_SESSION['classeChoisie'];
    $etudiantTirer = $STUDENT->drawStudent($classeChoisie);

    if ($etudiantTirer) {
        $_SESSION['etudiantTirer'] = $etudiantTirer;
    } else {
        $_SESSION['error'] = "Aucun étudiant trouvé pour cette classe.";
    }
}

// ✅ Attribution de note ou absence
if ($formType === "assign_grade" && isset($_POST['idStudent'])) {
    $idStudent = intval($_POST['idStudent']);

    if (isset($_POST['validerNote']) && isset($_POST['note'])) {
        $note = floatval($_POST['note']);

        if ($note >= 0 && $note <= 20) {
            $STUDENT->assignNote($idStudent, $note);
            $_SESSION['message'] = "Note attribuée avec succès.";
        } else {
            $_SESSION['error'] = "Veuillez entrer une note valide entre 0 et 20.";
        }
    }

    if (isset($_POST['absent'])) {
        $STUDENT->markStudentAbsent($idStudent);
        $_SESSION['message'] = "L'étudiant a été marqué absent.";
    }    

    // Nettoyage après note ou absence
    unset($_SESSION['etudiantTirer']);
}



// ✅ Récupérer l'étudiant tiré si encore en session
$etudiantTirer = isset($_SESSION['etudiantTirer']) ? $_SESSION['etudiantTirer'] : null;

// ✅ Si on vient d'une action autre que 'draw_student', on vide l'étudiant tiré
if ($formType !== "draw_student") {
    unset($_SESSION['etudiantTirer']);
}

$etudiantTirer = $_SESSION['etudiantTirer'] ?? null;

// ✅ Reinitialisation des passages et tout 
if ($formType === "reset_passages") {
    $STUDENT->resetPassages($_SESSION['classeChoisie']);
    $_SESSION['message'] = "Les passages ont été réinitialisés.";
}

if ($formType === "reset_all" ) {
    $STUDENT->resetAll($_SESSION['classeChoisie']);
    $_SESSION['message'] = "Tout a été réinitialisé.";
}

if ($formType === "reset_notes") {
    $STUDENT->resetNotes();
    $_SESSION['message'] = "Toutes les notes ont été réinitialisées.";
}

// ✅ Récupérer les messages
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;

// ✅ Nettoyer les messages après affichage
unset($_SESSION['message'], $_SESSION['error']);

// ✅ Inclure la vue `tirage.php`
include_once __DIR__ . "/../v/tirage.php";
?>
