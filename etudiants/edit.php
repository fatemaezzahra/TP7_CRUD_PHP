<?php
require_once '../database/connexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM etudiants WHERE id_etudiant = ?";  // Récupérer l'étudiant
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM formations"; // Récupérer les formations
$stmt = $pdo->query($sql);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Modifier l'étudiant
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE etudiants
            SET nom = ?, prenom = ?, email = ?, id_formation = ?
            WHERE id_etudiant = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $id_formation, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
</head>
<body>

    <h1>Modifier un étudiant</h1>

    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom"
               value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
        <br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom"
               value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
        <br><br>

        <label>Email :</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($etudiant['email'] ?? '') ?>">
        <br><br>

        <label>Formation :</label>
        <select name="id_formation" required>
            <?php foreach ($formations as $formation): ?>
                <option value="<?= $formation['id_formation'] ?>"
                    <?= $formation['id_formation'] == $etudiant['id_formation'] ? 'selected' : '' ?>>
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