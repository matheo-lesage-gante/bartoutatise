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
        body {
            background-color: #4a703c; /* Vert gaulois */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px 20px;
            color: #f5f1dc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: #f5f1dc;
            padding: 30px 25px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            color: #4a703c;
        }
        h1 {
            font-family: 'Papyrus', cursive, serif;
            font-size: 2.8rem;
            margin-bottom: 25px;
            text-align: center;
            color: #b79f57;
            text-shadow: 2px 2px #3b552d;
            border-bottom: 4px solid #b79f57;
            padding-bottom: 10px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 10px;
            border: 1.5px solid #b79f57;
            font-size: 1rem;
            color: #4a703c;
            resize: vertical;
            font-family: inherit;
        }
        textarea {
            min-height: 100px;
        }
        button {
            width: 48%;
            padding: 12px 0;
            margin-top: 20px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.3s ease;
        }
        button[type="submit"] {
            background-color: #a63e2a; /* Rouge gaulois */
            color: #f5f1dc;
            margin-right: 4%;
        }
        button[type="submit"]:hover {
            background-color: #7c2b20;
        }
        .cancel-button {
            background-color: #b79f57; /* Or gaulois */
            color: #4a703c;
        }
        .cancel-button:hover {
            background-color: #8a7c43;
            color: #fff8dc;
        }
        .error {
            color: #a63e2a;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ajouter un avis</h1>
    <?php if (!empty($erreur)) echo "<p class='error'>$erreur</p>"; ?>
    <form method="POST" novalidate>
        <label for="nom_bar">Nom du bar :</label>
        <input type="text" id="nom_bar" name="nom_bar" required>

        <label for="note">Note (1 à 5) :</label>
        <select id="note" name="note" required>
            <option value="">-- Sélectionnez --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="avis">Avis :</label>
        <textarea id="avis" name="avis" rows="4" required></textarea>

        <div style="display:flex; justify-content: space-between;">
            <button type="submit">Ajouter</button>
            <button type="button" class="cancel-button" onclick="window.location.href='mes_avis.php'">Annuler</button>
        </div>
    </form>
</div>

</body>
</html>
