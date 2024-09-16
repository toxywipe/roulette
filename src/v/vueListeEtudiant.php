<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="public\css\listeEtudiant.css">
    <title><?= htmlspecialchars($titre) ?></title>
</head>
<body>
    <h1>Étudiants de la classe <?= htmlspecialchars($nameClass) ?></h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Passage</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['surname']) ?></td>
                    <td><?= htmlspecialchars($student['firstname']) ?></td>
                    <td><?= $student['passage'] ? 'Oui' : 'Non' ?></td>
                    <td><?= is_null($student['noteaddition']) ? 'Non noté' : htmlspecialchars($student['noteaddition']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>