<?php
require_once '../database/connexion.php';

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un module</title>
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
        <h1>Ajouter un module</h1>

        <form method="POST">
            <label>Nom du module :</label>
            <input type="text" name="nom_module" required>

            <label>Coefficient :</label>
            <input type="number" name="coefficient">

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
            <a href="index.php" class="btn">Retour à la liste</a>
        </form>
    </div>

</body>
</html>