
<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom_formation'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];

    $sql = "INSERT INTO formations (nom_formation, description, duree)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $duree]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une formation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <nav>
        <h2>Centre de Formation</h2>
        <div>
            <a href="../index.php">Accueil</a>
            <a href="index.php">Formations</a>
            <a href="../etudiants/index.php">Étudiants</a>
            <a href="../modules/index.php">Modules</a>
        </div>
    </nav>

    <div class="container">

        <h1>Ajouter une formation</h1>

        <form method="POST">

            <label>Nom de la formation :</label>
            <input type="text" name="nom_formation" placeholder="Ex : Génie Informatique" required>

            <label>Description :</label>
            <textarea name="description" rows="4" placeholder="Description de la formation"></textarea>

            <label>Durée (mois) :</label>
            <input type="number" name="duree" min="1" placeholder="Ex : 24">

            <br><br>

            <button type="submit">Ajouter la formation</button>
            <a href="index.php" class="btn btn-delete">Annuler</a>

        </form>

    </div>

</body>
</html>
