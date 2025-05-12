<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Bar'Toutatise</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body style="justify-content: center">

		<?php require("../php/header.php");?> 
      
    <h2> Recherche d'amis </h2>
    <form method="post" action="formulaire.php">
        <label for="id">ID :</label>
        <input type="text" name="id" id="id" required/>
        <input type="submit" name="Envoyer" class="send_button" Value="Rechercher"/>
    </form>

    <h2> Mes amis </h2>
    <?php
        if (isset($_SESSION['Id'])) {
            $id = $_SESSION['Id'];
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
            if ($resultat['Ami1'] != NULL) {
                for ($index = 1; $index < 11; $index++) {
                    if ($resultat['Ami'.$index] != NULL){
                        $id_ami = $resultat['Ami'.$index];
                        try {
                            require("connexion.php");
                            $reqPrep = "SELECT * FROM profil WHERE Id = :id_ami";
                            $req = $conn->prepare($reqPrep);
                            $req->bindParam(':id_ami', $id_ami);
                            $req->execute();
                            $resultat_ami = $req->fetch();
                        } catch (Exception $e) {
                            die("Erreur : " . $e->getMessage());
                        }

                        echo "<div class='amis'>";
                        echo "<h3>" . htmlspecialchars($resultat_ami['Pseudo']) . "</h3>";
                        echo "<p> ID : " . htmlspecialchars($resultat_ami['Id']) . "</p>";
                        echo "<p> Email : " . htmlspecialchars($resultat_ami['Mail']) . "</p>";
                        echo "</div>";
                    }}
                }
            else {
                    echo "<p> Vous n'avez pas d'amis. </p>";
                }
            
        } else {
            echo "<p> Vous devez être connecté pour voir vos amis. </p>";
        }
    ?>

    </body>
</html>