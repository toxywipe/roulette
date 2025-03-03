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

// ✅ Vérifier quel formulaire a été soumis
$formType = isset($_POST['form_type']) ? $_POST['form_type'] : null;

// ✅ Sélection de la classe
if ($formType === "select_class" && !empty($_POST['class'])) {
    $_SESSION['classeChoisie'] = intval($_POST['class']);
}

// ✅ Tirage d’un étudiant
$etudiantTirer = null;
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
if ($formType === "assign_grade" && isset($_SESSION['etudiantTirer'])) {
    if (isset($_POST['note'])) {
        $note = floatval($_POST['note']);

        if ($note >= 0 && $note <= 20) {
            $STUDENT->assignNote($_SESSION['etudiantTirer']['id'], $note);
            $_SESSION['message'] = "Note attribuée avec succès.";
            unset($_SESSION['etudiantTirer']);
        } else {
            $_SESSION['error'] = "Veuillez entrer une note valide entre 0 et 20.";
        }
    }

    if (isset($_POST['absent'])) {
        $STUDENT->assignNote($_SESSION['etudiantTirer']['id'], null); // Null pour "Absent"
        $_SESSION['message'] = "L'étudiant a été marqué absent.";
        unset($_SESSION['etudiantTirer']);
    }
}

// ✅ Récupérer les messages
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;

// ✅ Nettoyer les messages après affichage
unset($_SESSION['message'], $_SESSION['error']);

// ✅ Inclure la vue `tirage.php`
include_once __DIR__ . "/../v/tirage.php";
?>
