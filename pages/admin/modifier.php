<?php
	if($_SESSION["authentifie"] != true || $_SESSION["admin"] != 2){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
        header("Location:../php/index.php");
    }
	if(isset($_GET["identifiant"]) && isset($_GET["admin"])){
		try{
			require("../Amis/connexion.php"); 

			$val = 0;
			if($_GET["admin"] == "non")
				$val = 1;
			$id = $_GET['identifiant']; //on recupere l identifiant passe dans l url
			$reqPrep="UPDATE profil SET admin = :val WHERE id = :id";//La requete SQL DELETES
			$req = $conn->prepare($reqPrep);//Préparer la requete
			$req->execute(array(
				':val' => $val,
				':id' => $id
			));
			
			header("Location:admin.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}
