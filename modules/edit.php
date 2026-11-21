<?php
require_once '../database/connexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Identifiant du module manquant.");
}

$sql = "SELECT * FROM modules WHERE id_module = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$module = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    die("Module introuvable.");
}

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un module</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <nav>
        <h2>Centre de Formation</h2>
        <div>
            <a href="../index.php">Accueil</a>
            <a href="../formations/index.php">Formations</a>
            <a href="../etudiants/index.php">Étudiants</a>
            <a href="index.php">Modules</a>
        </div>
    </nav>

    <div class="container">
        <h1>Modifier un module</h1>

        <form method="POST">
            <label>Nom du module :</label>
            <input type="text" name="nom_module"
                   value="<?= htmlspecialchars($module['nom_module']) ?>" required>

            <label>Coefficient :</label>
            <input type="number" name="coefficient"
                   value="<?= htmlspecialchars($module['coefficient'] ?? '') ?>">

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
            <a href="index.php" class="btn">Annuler</a>
        </form>
    </div>

</body>
</html>