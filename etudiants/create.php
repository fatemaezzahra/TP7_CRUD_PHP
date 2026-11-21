<?php
require_once '../database/connexion.php';

$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO etudiants (nom, prenom, email, id_formation)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $id_formation]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
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

        <h1>Ajouter un étudiant</h1>

        <form method="POST">

            <label>Nom :</label>
            <input type="text" name="nom" placeholder="Nom de l'étudiant" required>

            <label>Prénom :</label>
            <input type="text" name="prenom" placeholder="Prénom de l'étudiant" required>

            <label>Email :</label>
            <input type="email" name="email" placeholder="exemple@email.com">

            <label>Formation :</label>
            <select name="id_formation" required>
                <?php foreach ($formations as $formation): ?>
                    <option value="<?= $formation['id_formation'] ?>">
                        <?= htmlspecialchars($formation['nom_formation']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <button type="submit">Ajouter l'étudiant</button>
            <a href="index.php" class="btn btn-delete">Annuler</a>

        </form>

    </div>

</body>
</html>