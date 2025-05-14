<?php
// Connexion à la base de données
require("../Amis/connexion.php");

session_start();
if (!isset($_SESSION['Id'])) {
    header("Location: ../connexion.php");
    exit();
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_bar = htmlspecialchars(trim($_POST['nom_bar']));
    $note = intval($_POST['note']);
    $avis = htmlspecialchars(trim($_POST['avis']));
    $id_user = $_SESSION['Id'];

    if (!empty($nom_bar) && $note >=1 && $note <=5 && !empty($avis)) {
        $sql = "INSERT INTO avis (Id_profil, Nom_bar, note, avis) VALUES (:id_user, :nom_bar, :note, :avis)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':nom_bar', $nom_bar);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':avis', $avis);
        $stmt->execute();

        header("Location: mes_avis.php");
        exit();
    } else {
        $erreur = "Veuillez remplir tous les champs correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un avis</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ajouter un avis</h1>
    <?php if (!empty($erreur)) echo "<p class='error'>$erreur</p>"; ?>
    <form method="POST">
        <label>Nom du bar :</label>
        <input type="text" name="nom_bar" required>

        <label>Note (1 à 5) :</label>
        <select name="note" required>
            <option value="">-- Sélectionnez --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label>Avis :</label>
        <textarea name="avis" rows="4" required></textarea>

        <button type="submit">Ajouter</button>
        <button type="button" class="cancel-button" onclick="window.location.href='mes_avis.php'">Annuler</button>
    </form>
</div>

</body>
</html>
