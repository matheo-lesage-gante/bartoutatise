<?php
	//Fonctions pour valider les champs
	function nettoyer_donnees($donnees){
		$donnees=trim($donnees);
		$donnees=stripslashes($donnees);
		$donnees=htmlspecialchars($donnees);
		return $donnees;
	}
	
	function valider_NomPrenom($NomPrenom){
		$NomPrenom=nettoyer_donnees($NomPrenom);
		if(preg_match("/^[a-zA-Z ]*$/",$NomPrenom) && strlen($NomPrenom)<=40){
			return true;
		}
		else{
			return false;
		}
	}
	
	function valider_email($email){
		$email=nettoyer_donnees($email);
		$pattern="/^[a-zA-Z.-]+@junia.com$/";
		if(preg_match($pattern,$email)){
			return true;
		}
		else{
			return false;
		}
	}	
	
	function valider_Telephone($tel){
		$tel=nettoyer_donnees($tel);
		if(preg_match("/^0[0-9]{9}$/",$tel)){
			return true;
		}
		else{
			return false;
		}
	}
	
	//Tests bouton envoyer et methode POST
	if (!isset($_POST['Envoyer']) || $_SERVER["REQUEST_METHOD"] != "POST") {
		header('location:inscrire.php');
		die();
	}

	//Récuperer les données d'une façon sécurisée
	$vNom=nettoyer_donnees($_POST['nom']);
	$vPrenom=nettoyer_donnees($_POST['prenom']);
	$vEmail=nettoyer_donnees($_POST['email']);
	$vTel=nettoyer_donnees($_POST['tel']);
	$vPseudonyme=nettoyer_donnees($_POST['pseudonyme']);
	$vMotdePasse=nettoyer_donnees($_POST['mdp']);

    try{
        require("connexion.php");
        $reqPrep="SELECT * FROM membres WHERE Pseudonyme = :pseudonyme";
        $req = $conn->prepare($reqPrep);
        $req->bindParam(':pseudonyme', $vPseudonyme);
        $req->execute();
        $resultat = $req->fetch();
        if($resultat){
            setcookie('Validité',"Pseudonym already used",time()+(30),'/', '',false,true);
            header('location:inscrire.php');
            die();
        }
    }
    catch(Exception $e){
        die("Erreur : " . $e->getMessage());
    }

    //Tests si champs vides
	if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['pseudonyme']) || empty($_POST['mdp'])) {
		header('location:inscrire.php');
		die();
	}

	//Tests de validation des champs
	
	if (!valider_NomPrenom($vNom) && !valider_NomPrenom($vPrenom) && !valider_email($vEmail) && !valider_Telephone($vTel) && !valider_NomPrenom($vPseudonyme) && !valider_NomPrenom($vMotdePasse)){
		header('location:inscrire.php');
		die();
	}
    else{
		if(($_POST['pseudonyme']=="Tarkhna") || ($_POST['pseudonyme']=="paintique") || ($_POST['pseudonyme']=="flofus") || ($_POST['pseudonyme']=="Dertycroissant") || ($_POST['pseudonyme']=="legeniedaladdin") || ($_POST['pseudonyme']=="goken")){
			try{
				require("connexion.php");               
				
				//Compléter ICI
				$reqPrep="INSERT INTO membres (Nom, Prenom, Email, Telephone, Pseudonyme, MotdePasse, Score, Respo, IdImage) VALUES (:nom, :prenom, :email, :tel, :pseudonyme, :mdp, 0, 1, 0)";
				$req = $conn->prepare($reqPrep);
				$req->bindParam(':nom', $_POST['nom']);
				$req->bindParam(':prenom', $_POST['prenom']);
				$req->bindParam(':email', $_POST['email']);
				$req->bindParam(':tel', $_POST['tel']);
				$req->bindParam(':pseudonyme', $_POST['pseudonyme']);
				$req->bindParam(':mdp', hash('sha256',$_POST['mdp']));
				$req->execute();

				$reqPrep="INSERT INTO scoreboard (Pseudo, niv1, niv2, niv3, niv4, niv5, niv6, niv7, niv8, niv9, niv10, niv11, niv12, nivgen) VALUES (:pseudo, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
				$req = $conn->prepare($reqPrep);
				$req->bindParam(':pseudo', $_POST['pseudonyme']);
				$req->execute();

				$conn= NULL;
				header("Location:../Seconnecter/connecter.php");
			}                 
			catch(Exception $e){
				die("Erreur : " . $e->getMessage());
			}
		}
		else{
			try{
				require("connexion.php");               
				
				//Compléter ICI
				$reqPrep="INSERT INTO membres (Nom, Prenom, Email, Telephone, Pseudonyme, MotdePasse, Score, Respo, IdImage) VALUES (:nom, :prenom, :email, :tel, :pseudonyme, :mdp, 0, 0, 1)";
				$req = $conn->prepare($reqPrep);
				$req->bindParam(':nom', $_POST['nom']);
				$req->bindParam(':prenom', $_POST['prenom']);
				$req->bindParam(':email', $_POST['email']);
				$req->bindParam(':tel', $_POST['tel']);
				$req->bindParam(':pseudonyme', $_POST['pseudonyme']);
				$req->bindParam(':mdp', hash('sha256',$_POST['mdp']));
				$req->execute();
				
				$reqPrep="INSERT INTO scoreboard (Pseudo, niv1, niv2, niv3, niv4, niv5, niv6, niv7, niv8, niv9, niv10, niv11, niv12, nivgen) VALUES (:pseudo, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
				$req = $conn->prepare($reqPrep);
				$req->bindParam(':pseudo', $_POST['pseudonyme']);
				$req->execute();

				$conn= NULL;
				header("Location:../Seconnecter/connecter.php");
			}                 
			catch(Exception $e){
				die("Erreur : " . $e->getMessage());
			}
		}
			
        
    }

?>