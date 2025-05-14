<?php
// Connexion à la base de données
require("../Amis/connexion.php");

session_start();
if (!isset($_SESSION['Id'])) {
    header("Location: ../connexion.php");
    exit();
}

// Suppression d'un avis si un ID est passé en GET
if (isset($_GET['supprimer']) && is_numeric($_GET['supprimer'])) {
    $idAvis = intval($_GET['supprimer']);
    $idUser = $_SESSION['Id'];

    // Vérifie que l'avis appartient bien à l'utilisateur connecté
    $sqlDelete = "DELETE FROM avis WHERE Id_avis = :idAvis AND Id_profil = :idUser";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
    $stmtDelete->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmtDelete->execute();

    // Redirection après suppression
    header("Location: mes_avis.php");
    exit();
}

// Récupération des avis de l'utilisateur
$sql = "SELECT * FROM avis WHERE Id_profil = :id_user";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_user', $_SESSION['Id']);
$stmt->execute();
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
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .delete-button:hover {
            background-color: darkred;
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
<?php require("../php/header.php"); ?>

<div class="container">
    <h1>Liste des avis</h1>

    <?php if ($avis): ?>
        <?php foreach ($avis as $a): ?>
            <div class="avis">
                <h3><?= htmlspecialchars($a['Nom_bar']) ?> <span class="note">(<?= htmlspecialchars($a['note']) ?>/5)</span></h3>
                <p><?= nl2br(htmlspecialchars($a['avis'])) ?></p>
                <form method="GET" onsubmit="return confirm('Voulez-vous vraiment supprimer cet avis ?');">
                    <input type="hidden" name="supprimer" value="<?= $a['Id_avis'] ?>">
                    <button type="submit" class="delete-button">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun avis pour le moment.</p>
    <?php endif; ?>
</div>

<!-- Bouton pour ajouter un nouvel avis -->
<button class="add-button" onclick="window.location.href='ajouter_avis.php'">+</button>

</body>
</html>