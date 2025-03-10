<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Roulette - Tirage</title>
    <link rel="stylesheet" href="src/assets/tirage.css">
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

    <!--  Affichage des messages -->
    <?php if ($message) { ?>
        <p class="message-success"><?= htmlspecialchars($message) ?></p>
    <?php } ?>
    <?php if ($error) { ?>
        <p class="message-error"><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <!--  Sélection de la classe -->
    <form action="index.php?action=tirage" method="post">
        <input type="hidden" name="form_type" value="select_class">
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

    <!--  Tirage au sort d'un étudiant -->
    <?php if (!empty($_SESSION['classeChoisie'])) { ?>
        <h2>Tirer un étudiant au sort :</h2>
        <form action="index.php?action=tirage" method="post">
            <input type="hidden" name="form_type" value="draw_student">
            <button type="submit" name="tirage">Tirer un étudiant</button>
        </form>
    <?php } ?>

    <!--  Affichage de l'étudiant tiré et attribution de note -->
    <?php if ($etudiantTirer) { ?>
        <h2>Étudiant sélectionné :</h2>
        <p><?= htmlspecialchars($etudiantTirer['firstname'] . " " . $etudiantTirer['surname']) ?></p>

        <!--  Formulaire d'attribution de note ou d'absence -->
        <h2>Attribuer une note ou marquer une absence :</h2>
        <form action="index.php?action=tirage" method="post">
            <input type="hidden" name="form_type" value="assign_grade">
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
