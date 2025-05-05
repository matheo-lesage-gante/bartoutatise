<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Bar'Toutatise</title>
        <meta charset="utf-8" />
		<link rel="shortcut icon" href="../../media/logikcity.png" /> <!-- Inclure le logo -->
        <link rel="stylesheet" type="text/css" href="../../styles/general.css">
    	<link rel="stylesheet" type="text/css" href="../../styles/navbar.css">
    </head>
    <body style="justify-content: center">

		<?php require("../navigationBar.php");?>
	
    <h2> Recherche d'amis </h2>
    <form method="post" action="amis.php">
        <label for="pseudonyme">Pseudonyme :</label>
        <input type="text" name="pseudonyme" id="pseudonyme" required/>
        <input type="submit" name="Envoyer" class="send_button" Value="Rechercher"/>
    </form>

    </body>
</html>