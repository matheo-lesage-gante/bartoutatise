<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Bar'Toutatise</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../style.css">
    <style>
        body {
            margin: 0;
            padding-top: 80px; /* pour laisser de l'espace au header */
            background-color: green;
        }

        .amis-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .card-ami {
            background-color: #f5f5f5;
            border-radius: 12px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card-ami h3 {
            margin-bottom: 10px;
        }

        .card-ami p {
            margin: 5px 0;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .send_button {
            margin-top: 10px;
        }
    </style>
</head>
<body style="justify-content: center">

<?php require("../php/header.php");?> 

<h2>Recherche d'amis</h2>
<form method="post" action="formulaire.php">
    <label for="id">ID :</label>
    <input type="text" name="id" id="id" required />
    <input type="submit" name="Envoyer" class="send_button" value="Rechercher" />
</form>

<h2>Mes amis</h2>

<?php
if (isset($_SESSION['Id'])) {
    $id = $_SESSION['Id'];

    // Traitement suppression
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
                    echo "<p style='color:green;'>Ami supprimé avec succès.</p>";
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
        if (!empty($resultat['Ami'.$index])) {
            $aDesAmis = true;
            $id_ami = $resultat['Ami'.$index];

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
        echo "<p>Vous n'avez pas encore d'amis.</p>";
    }

} else {
    echo "<p>Vous devez être connecté pour voir vos amis.</p>";
}
die();
?>

</body>
</html>
