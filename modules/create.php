<?php
require_once '../database/connexion.php';

// Récupérer les formations
$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajouter un module
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_module = $_POST['nom_module'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO modules (nom_module, coefficient, id_formation)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_module, $coefficient, $id_formation]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
</head>
<body>

    <h1>Ajouter un module</h1>

    <form method="POST">
        <label>Nom du module :</label>
        <input type="text" name="nom_module" required><br><br>

        <label>Coefficient :</label>
        <input type="number" name="coefficient"><br><br>

        <label>Formation :</label>
        <select name="id_formation" required>
            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>">
                    <?= htmlspecialchars($formation['nom_formation']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>
        <button type="submit">Ajouter</button>
    </form>

    <br><a href="index.php">Retour à la liste</a>

</body>
</html>