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

    </body>
</html>