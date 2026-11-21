<?php
require_once '../database/connexion.php';

$sql = "SELECT modules.*, formations.nom_formation
        FROM modules
        INNER JOIN formations
        ON modules.id_formation = formations.id_formation";

$stmt = $pdo->query($sql);
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des modules</title>
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
        <h1>Liste des modules</h1>

        <p>Consulter et gérer les modules de formations disponibles dans notre centre.</p>

        <br>

        <a href="create.php" class="btn">Ajouter un module</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom du module</th>
                <th>Coefficient</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>

            <?php if (count($modules) > 0): ?>
                <?php foreach ($modules as $module): ?>
                    <tr>
                        <td><?= $module['id_module'] ?></td>
                        <td><?= htmlspecialchars($module['nom_module']) ?></td>
                        <td><?= htmlspecialchars($module['coefficient'] ?? '') ?></td>
                        <td><?= htmlspecialchars($module['nom_formation']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $module['id_module'] ?>" class="btn btn-edit">Modifier</a>
                            <a href="delete.php?id=<?= $module['id_module'] ?>" class="btn btn-delete">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Aucun module enregistré.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>