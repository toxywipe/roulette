<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur - Projet Roulette</title>
    <link rel="stylesheet" href="assets/accueil.css">
</head>
<body>
    <header class="header-container">
        <h1>Erreur</h1>
    </header>

    <div class="container">
        <h2>Oups ! Une erreur s'est produite.</h2>
        <p><?= isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : "Page non trouvée." ?></p>
        <a href="index.php?action=accueil">Retour à l'accueil</a>
    </div>
</body>
</html>

<?php
// Nettoyage de l'erreur après affichage
unset($_SESSION['error']);
?>
