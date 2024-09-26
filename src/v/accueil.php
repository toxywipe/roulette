<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Roulette</title>
    <link rel="stylesheet" href="public\css\accueil.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Projet ROULETTE</h1>
        </div>
    </header>

    <main class="container">
        <section class="interface">
            <!-- Section de sélection de la classe et gestion -->
            <h2>Choisir une Classe</h2>
            <form action="" method="POST">
                <select name="class" id="class">
                    <option value="BTS SIO">BTS SIO</option>
                    <option value="BTS MCO">BTS MCO</option>
                    <option value="BTS NDRC">BTS NDRC</option>
                </select>
                <button type="submit">Valider</button>
            </form>

            <div class="student-management">

                <!-- Section pour afficher la liste des étudiants -->
                <?php if (isset($printClass) && !empty($printClass)) : ?>
                    <div class="students-list">
                            <h2>Liste des étudiants de la classe : <?php echo $_SESSION['classeChoisie']; ?></h2>
                            <ul>
                            
                                <?php foreach ($printClass as $student): ?>
                                    <li><?php echo $student['surname'] . ' ' . $student['firstname']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                    </div>
                <?php endif; ?>

                <!-- Section pour tirer un étudiant au sort et lui attribuer une note ou le marquer absent -->
                <div class="random-student">
                    <h2>Tirer un étudiant au sort</h2>
                    <form action="" method="POST">
                        <button type="submit" name="tirer">Tirer un étudiant</button>
                    </form>
                    <?php if (isset($etudiantTirer)): ?>
                        <!-- Formulaire pour attribuer une note ou marquer comme absent -->
                        <div class="student-details">
                            <h3> Étudiant sélectionné : </h3>
                                <span id="selected-student">
                                    <?php
                                    if (isset($etudiantTirer)) {
                                        ?> <br> <h2> <?php echo $etudiantTirer['surname'] . ' ' . $etudiantTirer['firstname']; ?></h2><?php
                                    } else {
                                        echo 'Aucun étudiant sélectionné';
                                    }
                                    ?>
                                </span>

                            <!-- Formulaire pour attribuer une note ou marquer comme absent -->
                            <form action="" method="POST">
                                <h3>Attribuer une note :</h3>
                                <select name="note" id="note">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit" name="Noter">Noter</button>
                                <p style="text-align: center;"> Ou </p>
                                <button type="submit" name="absent">Eleves Absent</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            
            </div>

            <!-- Boutons d'action supplémentaires -->
            <button>Réinitialiser les options</button>
            <button>Ouvrir les paramètres</button>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Projet Roulette. Coucou !</p>
    </footer>

</body>
</html>
