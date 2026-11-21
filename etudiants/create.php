
<?php
require_once '../database/connexion.php';

// Récupérer les formations
$sql = "SELECT * FROM formations";
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajouter un étudiant
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
    <title>Ajouter un étudiant</title>
</head>
<body>

    <h1>Ajouter un étudiant</h1>

    <form method="POST">

        <label>Nom :</label>
        <input type="text" name="nom" required>
        <br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>
        <br><br>

        <label>Email :</label>
        <input type="email" name="email">
        <br><br>

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

    <br>
    <a href="index.php">Retour à la liste</a>

</body>
</html>
