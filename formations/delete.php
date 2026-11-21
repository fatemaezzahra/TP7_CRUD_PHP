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

    $sql = "DELETE FROM formations WHERE id_formation = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une formation</title>
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

        <h1>Supprimer une formation</h1>

        <form method="POST">

            <p>Voulez-vous vraiment supprimer cette formation ?</p>

            <p><strong>Nom :</strong> <?= htmlspecialchars($formation['nom_formation']) ?></p>

            <p><strong>Description :</strong> <?= htmlspecialchars($formation['description'] ?? '') ?></p>

            <p><strong>Durée :</strong> <?= htmlspecialchars($formation['duree']) ?> mois</p>

            <br>

            <button type="submit" class="btn-delete">Confirmer la suppression</button>

            <a href="index.php" class="btn">Annuler</a>

        </form>

    </div>

</body>
</html>