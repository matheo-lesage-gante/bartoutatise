<!DOCTYPE html5>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <?php include 'header.php'?>
    <h2> Rechercher un ami</h2>
    <form action="amis.php" method="post">
      <input type="text" name="search" placeholder="Rechercher un ami">
      <input type="submit" value="Rechercher">
    </form>
    SELECT * FROM profil WHERE id = %search;
    <h2>Ajouter un ami</h2>
    <form action="amis.php" method="post">
      <input type="text" name="add" placeholder="Ajouter un ami">
      <input type="submit" value="Ajouter">
    </form>
    <h2>Supprimer un ami</h2>
    <form action="amis.php" method="post">
      <input type="text" name="delete" placeholder="Supprimer un ami">
      <input type="submit" value="Supprimer">
    </form>
    <h2>Mes demandes d'amis</h2>
    <form action="amis.php" method="post">
      <input type="text" name="demandes" placeholder="Mes demandes d'amis">
      <input type="submit" value="Voir les demandes">
    </form>
    <h2>Mes amis</h2>
    
  </body>
</html>