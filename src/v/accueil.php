<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet Roulette - Accueil</title>
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
    <h2>Liste des Classes et Étudiants</h2>

    <?php if (!empty($classes)) { ?>
        <div class="class-container">
            <?php foreach ($classes as $classe) { ?>
                <div class="class-block"> 
                    <h3><?= htmlspecialchars($classe['nameClass']) ?></h3>
                    <ul>
                        <?php 
                        $students = $STUDENT->getStudentsByClass($classe['idClass']);
                        if (!empty($students)) {
                            foreach ($students as $student) { ?>
                                <li class="student-item"><?= htmlspecialchars($student['firstname'] . " " . $student['surname']) ?></li>
                        <?php }
                        } else { ?>
                            <li class="no-student">Aucun étudiant dans cette classe.</li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="no-class">Aucune classe disponible.</p>
    <?php } ?>
</main>


<footer>
    <p>&copy; 2025 Projet Roulette - Tous droits réservés.</p>
</footer>

</body>
</html>
