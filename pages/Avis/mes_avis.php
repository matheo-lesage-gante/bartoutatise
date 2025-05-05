<?php
// Connexion à la base de données (modifie les infos selon ton serveur)
require("../Amis/connexion.php");

// Récupérer les avis depuis la base
$sql = "SELECT * FROM avis";
$stmt = $conn->query($sql);
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des avis</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .container {
            max-width: 700px;
            margin: auto;
        }
        .avis {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 15px;
            margin-bottom: 15px;
        }
        .avis h3 {
            margin: 0 0 5px 0;
            color: #333;
        }
        .avis p {
            margin: 0;
            color: #555;
        }
        .note {
            font-weight: bold;
            color: #007BFF;
        }
        .add-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            cursor: pointer;
            transition: background 0.3s;
        }
        .add-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<?php require("../../header.php");?>
<div class="container">
    <h1>Liste des avis</h1>
    <?php if ($avis): ?>
        <?php foreach ($avis as $a): ?>
            <div class="avis">
                <h3><?= htmlspecialchars($a['Nom_bar']) ?> <span class="note">(<?= htmlspecialchars($a['note']) ?>/5)</span></h3>
                <p><?= nl2br(htmlspecialchars($a['avis'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun avis pour le moment.</p>
    <?php endif; ?>
</div>

<!-- Bouton en bas à droite -->
<button class="add-button" onclick="window.location.href='ajouter_avis.php'">+</button>

</body>
</html>
