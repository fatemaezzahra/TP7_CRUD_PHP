<?php
require_once '../database/connexion.php';

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des formations</title>
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

        <h1>Gestion des formations</h1>

        <p>Consultez et gérez les formations disponibles dans notre centre.</p>

        <br>

        <a href="create.php" class="btn">+ Ajouter une formation</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($formations as $formation): ?>
            <tr>
                <td><?= $formation['id_formation'] ?></td>
                <td><?= htmlspecialchars($formation['nom_formation']) ?></td>
                <td><?= htmlspecialchars($formation['description']) ?></td>
                <td><?= $formation['duree'] ?> mois</td>
                <td>
                    <a href="edit.php?id=<?= $formation['id_formation'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $formation['id_formation'] ?>" class="btn btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($formations)): ?>
            <tr>
                <td colspan="5">Aucune formation disponible.</td>
            </tr>
            <?php endif; ?>

        </table>

    </div>

</body>
</html>