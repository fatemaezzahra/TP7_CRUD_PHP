<?php
require_once '../database/connexion.php';

$id = $_GET['id'];

$sql = "SELECT etudiants.*, formations.nom_formation
        FROM etudiants
        INNER JOIN formations
        ON etudiants.id_formation = formations.id_formation
        WHERE etudiants.id_etudiant = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Étudiant introuvable.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "DELETE FROM etudiants WHERE id_etudiant = ?";
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
    <title>Supprimer un étudiant</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <nav>
        <h2>Centre de Formation</h2>
        <div>
            <a href="../index.php">Accueil</a>
            <a href="../formations/index.php">Formations</a>
            <a href="index.php">Étudiants</a>
            <a href="../modules/index.php">Modules</a>
        </div>
    </nav>

    <div class="container">

        <h1>Supprimer un étudiant</h1>

        <form method="POST">

            <p>Voulez-vous vraiment supprimer cet étudiant ?</p>

            <p><strong>Nom :</strong> <?= htmlspecialchars($etudiant['nom']) ?></p>

            <p><strong>Prénom :</strong> <?= htmlspecialchars($etudiant['prenom']) ?></p>

            <p><strong>Email :</strong> <?= htmlspecialchars($etudiant['email'] ?? '') ?></p>

            <p><strong>Formation :</strong> <?= htmlspecialchars($etudiant['nom_formation']) ?></p>

            <br>

            <button type="submit" class="btn-delete">Confirmer la suppression</button>

            <a href="index.php" class="btn">Annuler</a>

        </form>

    </div>

</body>
</html>