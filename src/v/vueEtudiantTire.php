<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étudiant tiré au sort</title>
</head>
<body>
    <h1>Étudiant tiré au sort</h1>

    <?php if (!empty($student)): ?>
        <p>
            <strong>Nom :</strong> <?= htmlspecialchars($student['surname']) ?><br>
            <strong>Prénom :</strong> <?= htmlspecialchars($student['firstname']) ?><br>
        </p>

        <!-- Formulaire pour affecter une note -->
        <form action="index.php?action=setGrade" method="POST">
            <input type="hidden" name="studentId" value="<?= $student['id'] ?>">
            <input type="hidden" name="nameClass" value="<?= urlencode($nameClass) ?>">
            <label for="grade">Note :</label>
            <input type="number" id="grade" name="grade" min="0" max="20" required>
            <button type="submit">Affecter la note</button>
        </form>
    <?php else: ?>
        <p>Aucun étudiant n'a été tiré au sort.</p>
    <?php endif; ?>

    <a href="index.php?action=showStudents&nameClass=<?= urlencode($nameClass) ?>">Retour à la liste des étudiants</a>
</body>
</html>
