<?php
require_once '../database/connexion.php';

$id = $_GET['id'];  // Récupérer la formation à modifier

$sql = "SELECT * FROM formations WHERE id_formation = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$formation = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Modifier la formation
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
    <title>Modifier une formation</title>
</head>
<body>

    <h1>Modifier une formation</h1>

    <form method="POST">
        <label>Nom de la formation :</label>
        <input type="text" name="nom_formation"
               value="<?= htmlspecialchars($formation['nom_formation']) ?>" required>
        <br><br>

        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($formation['description'] ?? '') ?></textarea>
        <br><br>

        <label>Durée (mois) :</label>
        <input type="number" name="duree" value="<?= htmlspecialchars($formation['duree'] ?? '') ?>">
        <br><br>

        <button type="submit">Enregistrer les modifications</button>
    </form>

    <br><a href="index.php">Retour à la liste</a>

</body>
</html>