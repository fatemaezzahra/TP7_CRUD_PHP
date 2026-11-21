<?php
require_once '../database/connexion.php';

$sql = "SELECT etudiants.*, formations.nom_formation
        FROM etudiants
        INNER JOIN formations
        ON etudiants.id_formation = formations.id_formation";

$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants</title>
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

        <h1>Gestion des étudiants</h1>

        <p>Consultez et gérez les étudiants inscrits dans notre centre.</p>

        <br>

        <a href="create.php" class="btn">+ Ajouter un étudiant</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Formation</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant['id_etudiant'] ?></td>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= htmlspecialchars($etudiant['email']) ?></td>
                <td><?= htmlspecialchars($etudiant['nom_formation']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $etudiant['id_etudiant'] ?>" class="btn btn-edit">Modifier</a>
                    <a href="delete.php?id=<?= $etudiant['id_etudiant'] ?>" class="btn btn-delete">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($etudiants)): ?>
            <tr>
                <td colspan="6">Aucun étudiant disponible.</td>
            </tr>
            <?php endif; ?>

        </table>

    </div>

</body>
</html>