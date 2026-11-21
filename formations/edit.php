<?php
require_once '../database/connexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM formations WHERE id_formation = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    die("Formation introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom_formation'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];

    $sql = "UPDATE formations
            SET nom_formation = ?, description = ?, duree = ?
            WHERE id_formation = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $description, $duree, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une formation</title>
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

        <h1>Modifier une formation</h1>

        <form method="POST">

            <label>Nom de la formation :</label>
            <input type="text" name="nom_formation"
                   value="<?= htmlspecialchars($formation['nom_formation']) ?>" required>

            <label>Description :</label>
            <textarea name="description" rows="4"><?= htmlspecialchars($formation['description'] ?? '') ?></textarea>

            <label>Durée (mois) :</label>
            <input type="number" name="duree" min="1"
                   value="<?= htmlspecialchars($formation['duree'] ?? '') ?>">

            <br><br>

            <button type="submit">Enregistrer les modifications</button>
            <a href="index.php" class="btn btn-delete">Annuler</a>

        </form>

    </div>

</body>
</html>