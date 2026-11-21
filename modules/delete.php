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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM modules WHERE id_module = ?";
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
    <title>Supprimer un module</title>
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
        <h1>Supprimer un module</h1>

        <form method="POST">
            <p>Voulez-vous vraiment supprimer le module
                <strong><?= htmlspecialchars($module['nom_module']) ?></strong> ?
            </p>

            <button type="submit" class="btn-delete">Confirmer la suppression</button>
            <a href="index.php" class="btn">Annuler</a>
        </form>
    </div>

</body>
</html>