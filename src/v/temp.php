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
            <!-- Menu de navigation -->
            <nav>
                <ul>
                    <li><a href="tirage.php">Tirage au Sort</a></li>
                    <li><a href="gestion_etudiants.php">Gestion des Étudiants</a></li>
                    <li><a href="reset.php"><i class="material-icons"></i>Reset</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Menu pour choisir la classe -->
            <section class="class-selection">
                <h2>Choisir une Classe</h2>
                <form action="#" method="GET">
                    <select name="class" id="class">
                        <option value="BTS SIO">BTS SIO</option>
                        <option value="BTS MCO">BTS MCO</option>
                        <option value="BTS NDRC">BTS NDRC</option>
                    </select>
                    <button type="submit">Valider</button>
                </form>
            </section>

            <!-- Interface avec plusieurs sections : Liste, Tirage, Réinitialiser, Paramètres -->
            <section class="interface">
                <!-- Liste des étudiants -->
                <div class="students-list">
                    <h3>Liste des Étudiants</h3>
                    <ul>
                        <li>Efecan ÖZTAS</li>
                        <li>Ilhan ALTINTOP</li>
                        <li>Gokhan ASLAN</li>
                        <!-- Ajoute ici la liste complète des étudiants -->
                    </ul>
                </div>

                <!-- Tirage au sort -->
                <div class="draw-student">
                    <h3>Tirer au Sort un Étudiant</h3>
                    <button>Tirer un étudiant</button>
                </div>

                <!-- Réinitialiser -->
                <div class="reset-options">
                    <h3>Réinitialiser</h3>
                    <button>Réinitialiser le tirage</button>
                    <button>Réinitialiser tirage + notes</button>
                </div>

                <!-- Paramètres -->
                <div class="settings">
                    <h3>Paramètres</h3>
                    <button>
                        <i class="material-icons">settings</i> Paramètres
                    </button>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 - Projet ROULETTE</p>
        </div>
    </footer>
</body>
</html>
