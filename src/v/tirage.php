<?php
// ✅ Vérifier si la session est active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "src/m/bd.class.inc.php";
include_once "src/m/bd.student.inc.php";

$CLASS = new modele_class();
$STUDENT = new modele_student();

// ✅ Récupérer toutes les classes
$classes = $CLASS->getAllClasses();
$etudiantTirer = isset($_SESSION['etudiantTirer']) ? $_SESSION['etudiantTirer'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;

// ✅ Nettoyer les messages après affichage
unset($_SESSION['message'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Roulette - Tirage</title>
    <link rel="stylesheet" href="src/assets/accueil.css">
</head>
<body>

<header>
    <div class="header-container">
        <h1>Projet Roulette</h1>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php?action=accueil">Accueil</a></li>
                <li><a href="index.php?action=tirage">Tirage</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <h2>Effectuer un tirage au sort</h2>

    <!-- ✅ Affichage des messages -->
    <?php if ($message) { ?>
        <p class="message-success"><?= htmlspecialchars($message) ?></p>
    <?php } ?>
    <?php if ($error) { ?>
        <p class="message-error"><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <!-- ✅ Sélection de la classe -->
    <form action="src/c/controllerTirage.php" method="post">
        <label for="class">Choisissez une classe :</label>
        <select name="class" id="class" required>
            <option value="">-- Sélectionnez une classe --</option>
            <?php foreach ($classes as $classe) { ?>
                <option value="<?= htmlspecialchars($classe['idClass']) ?>">
                    <?= htmlspecialchars($classe['nameClass']) ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Sélectionner</button>
    </form>

    <!-- ✅ Tirage au sort d'un étudiant -->
    <?php if (!empty($_SESSION['classeChoisie'])) { ?>
        <h2>Tirer un étudiant au sort :</h2>
        <form action="src/c/controllerTirage.php" method="post">
            <button type="submit" name="tirage">Tirer un étudiant</button>
        </form>
    <?php } ?>

    <!-- ✅ Affichage de l'étudiant tiré et attribution de note -->
    <?php if ($etudiantTirer) { ?>
        <h2>Étudiant sélectionné :</h2>
        <p><?= htmlspecialchars($etudiantTirer['firstname'] . " " . $etudiantTirer['surname']) ?></p>

        <!-- ✅ Formulaire d'attribution de note ou d'absence -->
        <h2>Attribuer une note ou marquer une absence :</h2>
        <form action="src/c/controllerTirage.php" method="post">
            <label for="note">Note :</label>
            <input type="number" name="note" min="0" max="20" step="0.5">
            <button type="submit" name="validerNote">Valider</button>
            <button type="submit" name="absent">Absent</button>
        </form>
    <?php } ?>
</main>

<footer>
    <p>&copy; 2025 Projet Roulette - Tous droits réservés.</p>
</footer>

</body>
</html>
