<?php

    if($_SESSION["authentifie"] != true || $_SESSION["admin"] != 2){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
        header("Location:../php/index.php");
    }

	if(isset($_GET["identifiant"]) && isset($_GET["type"])){
		try{
			require("connexion.php"); 

			if($_GET["type"] == "user"){
				$reqPrep="DELETE FROM profil WHERE id = :id";
			}
			$id = $_GET['identifiant']; //on recupere l identifiant passe dans l url
			$req = $conn->prepare($reqPrep);//Préparer la requete
			$req->execute(array(
				':id' => $id
			));
			
			header("Location:admin.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

?>