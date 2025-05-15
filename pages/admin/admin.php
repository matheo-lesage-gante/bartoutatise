<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php include '../php/header.php'; ?>
    <?php 
    if($_SESSION["authentifie"] != true || $_SESSION["admin"] != 2){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
        header("Location:../php/index.php");
    }
    require("../Amis/connexion.php");?>
    <div class="admin">
            <h1>Gestion administrateurs</h1>

            <h2>Comptes</h2>

            <?php
				
			$reqPrep="SELECT Id, Mail, Pseudo, Admin FROM profil";//La requete SQL SELECT
			$req = $conn->prepare($reqPrep);//Préparer la requete
            $req->execute();//Executer la requete
				
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
				
			//Affichage sous forme d'un tableau
			echo "<table>
			<tr>
			<th>Id</th>
			<th>Email</th>
			<th>Pseudo</th>
			<th>Administrateur</th>
			<th colspan=2>Action</th>
			</tr>";
			$id = 0;
			$nb = 0;
			foreach ($resultat as $ligne){
				echo "<tr>";
				foreach ($ligne as $element => $valeur){
                    if($element == "Admin"){
                        if($valeur == 1)
                        echo "<td>oui</td>";
                    else echo "<td>non</td>";
                    }
					else echo "<td>$valeur</td>";
					if($nb == 0){
						$id = $valeur;
					}
					$nb++;
				}
				$nb = 0;
							
				if($valeur == 0 )
                    echo "<td><a href='modifier.php?identifiant=$id&admin=non'>Passer Administrateur</a></td>";
                else
                    echo "<td><a href='modifier.php?identifiant=$id&admin=oui'>Retirer Administrateur</a></td>";
				echo "<td><a href='supprimer.php?identifiant=$id&type=user'>Supprimer</a></td>";
				echo "</tr>";
			}
			echo "</table>";
				
			$conn= NULL;// On ferme la connexion	?>
    </div>
            <!-- <h2>Auberges</h2> -->
           
</body>
</html>