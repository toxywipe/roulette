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

    <!-- ✅ Barre sélection classe -->
    <div class="selection-bar">
        <form action="index.php?action=tirage" method="post" class="selection-form">
            <input type="hidden" name="form_type" value="select_class">
            <select name="class" id="class" required>
                <option value="">-- Sélectionnez une classe --</option>
                <?php foreach ($classes as $classe) { ?>
                    <option value="<?= htmlspecialchars($classe['idClass']) ?>"
                        <?php if (isset($_SESSION['classeChoisie']) && $_SESSION['classeChoisie'] == $classe['idClass']) echo 'selected'; ?>>
                        <?= htmlspecialchars($classe['nameClass']) ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="btn-validate">Sélectionner</button>
        </form>
    </div>

    <!-- ✅ Messages succès / erreur -->
    <?php if ($message) { ?>
        <p class="message-success"><?= htmlspecialchars($message) ?></p>
    <?php } ?>
    <?php if ($error) { ?>
        <p class="message-error"><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <!-- ✅ Layout principal -->
    <div class="tirage-layout">
        <!-- ✅ Colonne Gauche : Liste étudiants -->
        <div class="left-column">
            <div class="class-block">
                <?php if (isset($_SESSION['classeChoisie']) && isset($classes)) { 
                    foreach ($classes as $classe) {
                        if ($classe['idClass'] == $_SESSION['classeChoisie']) { ?>
                            <h3>Liste des étudiants du <?= htmlspecialchars($classe['nameClass']) ?></h3>
                            <ul>
                                <?php if (!empty($students)) { 
                                    foreach ($students as $student) { ?>
                                        <li class="student-item"><?= htmlspecialchars($student['firstname'] . " " . $student['surname']) ?></li>
                                <?php } 
                                } else { ?>
                                    <li class="no-student">Aucun étudiant dans cette classe.</li>
                                <?php } ?>
                            </ul>
                        <?php }
                    }
                } ?>
            </div>
        </div>




        <!-- ✅ Colonne Droite : Tirage + Actions -->
        <div class="right-column">
            <h2>Tirage au sort</h2>

            <?php if (isset($_SESSION['classeChoisie']) && !empty($_SESSION['classeChoisie'])) { ?>
                <form action="index.php?action=tirage" method="post" class="draw-form">
                    <input type="hidden" name="form_type" value="draw_student">
                    <button type="submit" name="tirage" class="btn-draw">Tirer un étudiant</button>
                </form>
            <?php } ?>

            <?php if ($etudiantTirer) { ?>
                <div class="student-selected">
                    <?= htmlspecialchars($etudiantTirer['firstname'] . " " . $etudiantTirer['surname']) ?>
                </div>

                <h3>Attribuer une note ou marquer une absence :</h3>
                <form action="index.php?action=tirage" method="post" class="note-form">
                    <input type="hidden" name="form_type" value="assign_grade">
                    <input type="hidden" name="idStudent" value="<?= htmlspecialchars($etudiantTirer['id']) ?>">
                    <input type="number" name="note" min="0" max="20" step="0.5" placeholder="Note">
                    <div class="note-buttons">
                        <button type="submit" name="validerNote" class="btn-validate">Valider</button>
                        <button type="submit" name="absent" class="btn-absent">Absent</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

    <div class="reset-buttons">
        <form action="index.php?action=tirage" method="post" style="display:inline-block;">
            <input type="hidden" name="form_type" value="reset_passages">
            <button type="submit" class="btn-reset">Réinitialiser les tirages</button>
        </form>
        
        <form action="index.php?action=tirage" method="post" style="display:inline-block;">
            <input type="hidden" name="form_type" value="reset_notes">
            <button type="submit" class="btn-reset">Réinitialiser les notes</button>
        </form>

        <form action="index.php?action=tirage" method="post" style="display:inline-block;">
            <input type="hidden" name="form_type" value="reset_all">
            <button type="submit" class="btn-reset">Réinitialiser tout</button>
        </form>
    </div>

</main>

<footer>
    <p>&copy; 2025 Projet Roulette - Tous droits réservés.</p>
</footer>

</body>
</html>
