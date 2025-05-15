<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Bar'Toutatise</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../style.css">
    <style>
        body {
            margin: 0;
            padding-top: 80px; /* pour ne pas que le header se superpose */
            background-color: #6b8e23;
            background-size: cover;
            font-family: 'Papyrus', cursive;
            color: #2c1f0c;
        }

        h2 {
            text-align: center;
            color: #7f4f24;
            font-size: 32px;
            text-shadow: 1px 1px 0 #fff;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .send_button {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            background-color: #f4a261;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
        }

        .send_button:hover {
            background-color: #e76f51;
        }

        .amis-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
            padding: 0 20px;
        }

        .card-ami {
            background-color: #fff3cd;
            border-radius: 16px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 6px 10px rgba(0,0,0,0.15);
            text-align: center;
            border: 3px solid #7f4f24;
        }

        .card-ami h3 {
            margin-bottom: 10px;
            font-size: 22px;
            color: #7f4f24;
        }

        .card-ami p {
            margin: 5px 0;
            font-size: 16px;
        }

        .delete-button {
            background-color: #c1121f;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        .delete-button:hover {
            background-color: #780000;
        }

        p {
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>

<?php require("../php/header.php"); ?> 

<h2>🔍 Recherche d’un Gaulois</h2>
<form method="post" action="formulaire.php">
    <label for="id">ID :</label>
    <input type="text" name="id" id="id" required />
    <input type="submit" name="Envoyer" class="send_button" value="Rechercher" />
</form>

<h2>🛡️ Mes compagnons de bataille</h2>

<?php

if (isset($_SESSION['Id'])) {
    $id = $_SESSION['Id'];

    // Suppression d'un ami
    if (isset($_POST['supprimer_ami'])) {
        $amiASupprimer = $_POST['ami_id'];
        try {
            require("connexion.php");
            $req = $conn->prepare("SELECT * FROM profil WHERE Id = :id");
            $req->bindParam(':id', $id);
            $req->execute();
            $profil = $req->fetch();

            for ($i = 1; $i <= 10; $i++) {
                if ($profil["Ami$i"] == $amiASupprimer) {
                    $col = "Ami$i";
                    $update = $conn->prepare("UPDATE profil SET $col = NULL WHERE Id = :id");
                    $update->bindParam(':id', $id);
                    $update->execute();
                    echo "<p style='color:green;'>Ce valeureux guerrier a été banni du village.</p>";
                    break;
                }
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    // Affichage des amis
    try {
        require("connexion.php");
        $req = $conn->prepare("SELECT * FROM profil WHERE Id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        $resultat = $req->fetch();
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }

    echo "<div class='amis-container'>";
    $aDesAmis = false;
    for ($index = 1; $index <= 10; $index++) {
        if (!empty($resultat['Ami' . $index])) {
            $aDesAmis = true;
            $id_ami = $resultat['Ami' . $index];

            try {
                require("connexion.php");
                $req = $conn->prepare("SELECT * FROM profil WHERE Id = :id_ami");
                $req->bindParam(':id_ami', $id_ami);
                $req->execute();
                $ami = $req->fetch();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }

            echo "<div class='card-ami'>";
            echo "<h3>" . htmlspecialchars($ami['Pseudo']) . "</h3>";
            echo "<p>ID : " . htmlspecialchars($ami['Id']) . "</p>";
            echo "<p>Email : " . htmlspecialchars($ami['Mail']) . "</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='ami_id' value='" . $ami['Id'] . "' />";
            echo "<input type='submit' name='supprimer_ami' value='Supprimer' class='delete-button' />";
            echo "</form>";
            echo "</div>";
        }
    }
    echo "</div>";

    if (!$aDesAmis) {
        echo "<p>Pas de compagnons pour l’instant... Par Toutatis, il faut y remédier !</p>";
    }

} else {
    echo "<p>Tu dois être connecté pour rejoindre la tribu des irréductibles.</p>";
}
?>
</body>
</html>
