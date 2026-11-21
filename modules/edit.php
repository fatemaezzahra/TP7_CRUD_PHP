<?php
require_once '../database/connexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM modules WHERE id_module = ?";  // Récupérer le module
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM formations";  // Récupérer les formations
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Modifier le module
    $nom_module = $_POST['nom_module'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE modules
            SET nom_module = ?, coefficient = ?, id_formation = ?
            WHERE id_module = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_module, $coefficient, $id_formation, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un module</title>
</head>
<body>

    <h1>Modifier un module</h1>

    <form method="POST">
        <label>Nom du module :</label>
        <input type="text" name="nom_module"
               value="<?= htmlspecialchars($module['nom_module']) ?>" required>
        <br><br>

        <label>Coefficient :</label>
        <input type="number" name="coefficient"
               value="<?= htmlspecialchars($module['coefficient'] ?? '') ?>">
        <br><br>

        <label>Formation :</label>
        <select name="id_formation" required>
            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= $formation['id_formation'] == $module['id_formation'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($formation['nom_formation']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>
        <button type="submit">Enregistrer les modifications</button>
    </form>

    <br><a href="index.php">Retour à la liste</a>

</body>
</html>