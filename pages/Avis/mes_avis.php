<?php
// Connexion à la base de données
require("../Amis/connexion.php");

session_start();

if (!isset($_SESSION['Id'])) {
    header("Location: ../php/login.php");
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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #4a703c; /* Vert gaulois */
            margin: 0;
            padding: 20px;
            color: #f5f1dc;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background-color: #f5f1dc;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
            color: #4a703c;
        }
        h1 {
            font-family: 'Papyrus', cursive, serif;
            font-size: 3rem;
            text-align: center;
            margin-bottom: 30px;
            color: #b79f57;
            text-shadow: 2px 2px #3b552d;
            border-bottom: 4px solid #b79f57;
            padding-bottom: 8px;
        }
        .avis {
            background: #fff8dc;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            padding: 20px;
            margin-bottom: 20px;
            color: #4a703c;
        }
        .avis h3 {
            margin: 0 0 10px 0;
            color: #6b4e0e;
            font-weight: bold;
        }
        .avis p {
            margin: 0;
            color: #4a4a2a;
            font-size: 1.1rem;
        }
        .note {
            font-weight: bold;
            color: #b79f57;
            font-size: 1.1rem;
        }
        .delete-button {
            background-color: #a63e2a; /* Rouge gaulois */
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 12px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .delete-button:hover {
            background-color: #7c2b20;
        }
        .add-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #b79f57;
            color: #4a703c;
            border: none;
            padding: 18px 24px;
            border-radius: 50%;
            font-size: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
        }
        .add-button:hover {
            background: #8a7c43;
            color: #fff8dc;
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
