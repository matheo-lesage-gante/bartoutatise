<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Bar'Toutatise</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body style="justify-content: center">

		<?php require("../../header.php");?>
	
    <h2> Recherche d'amis </h2>
    <form method="post" action="formulaire.php">
        <label for="id">ID :</label>
        <input type="text" name="id" id="id" required/>
        <input type="submit" name="Envoyer" class="send_button" Value="Rechercher"/>
    </form>

    <h2> Mes amis </h2>
    <?php
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            try {
                require("connexion.php");
                $reqPrep = "SELECT * FROM profil WHERE Id = :id";
                $req = $conn->prepare($reqPrep);
                $req->bindParam(':id', $id);
                $req->execute();
                $resultat = $req->fetch();
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }

            for ($index = 1; $index < 11; $index++) {
                if ($resultat['Ami'.$index] != NULL) {
                    echo "<p> Ami".$index." : " . $resultat['Ami'.$index] . "</p>";
                }
            }
        } else {
            echo "<p> Vous devez être connecté pour voir vos amis. </p>";
        }
    ?>

    </body>
</html>