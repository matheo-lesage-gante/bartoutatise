<?php
	//Fonctions pour valider les champs
	function nettoyer_donnees($donnees){
		$donnees=trim($donnees);
		$donnees=stripslashes($donnees);
		$donnees=htmlspecialchars($donnees);
		return $donnees;
	}	
	
	function valider_ID($id){
		$id=nettoyer_donnees($id);
		if(preg_match("/^[0-9]{1}$/",$id)){
			return true;
		}
		else{
			return false;
		}
	}
	
	//Tests bouton envoyer et methode POST
	if (!isset($_POST['Envoyer']) || $_SERVER["REQUEST_METHOD"] != "POST") {
		header('location:amis.php');
		die();
	}

	//Tests si champs vides
	if (empty($_POST['id'])) {
		header('location:amis.php');
		die();
	}

	//Récuperer les données d'une façon sécurisée
	$vID=nettoyer_donnees($_POST['id']);

    try{
        require("connexion.php");
        $reqPrep="SELECT * FROM profil WHERE Id = :id";
        $req = $conn->prepare($reqPrep);
        $req->bindParam(':id', $vID);
        $req->execute();
        $resultat = $req->fetch();
    }
    catch(Exception $e){
        die("Erreur : " . $e->getMessage());
    }

	//Tests de validation des champs
	
	if (!valider_ID($vID)){
		header('location:amis.php');
		die();
	}
	else if ($resultat == false) {
		echo "<h2> L'utilisateur n'existe pas </h2>";
	}
	else{
		// Si l'utilisateur existe

		echo "<h2> Pseudo : " . $resultat['Pseudo'] . "</h2>";
		echo "<p> ID : " . $resultat['Id'] . "</p>";
		for ($index = 1; $index < 11; $index++) {
			if ($resultat['Ami'.$index] != NULL) {
				echo "<p> Ami".$index." : " . $resultat['Ami'.$index] . "</p>";
			}
		}

		echo "<form method='post' action=''>";
		echo "<input type='hidden' name='id_ami' value='" . $resultat['Id'] . "'>";
		echo "<input type='submit' name='Ajouter' value='Ajouter un ami' class='send_button'>";
		echo "</form>";

		echo "<input type='button' value='Retour' onclick=\"window.location.href='amis.php'\" class='send_button'>";
	}

// Traitement de l’ajout d’ami
if (isset($_POST['Ajouter'])) {
    $idAmi = nettoyer_donnees($_POST['id_ami']);
    session_start();
    $monId = $_SESSION['Id']; // il faut stocker l'ID de l'utilisateur connecté en session

    try {
        // Récupérer mes amis actuels
        $reqPrep = "SELECT * FROM profil WHERE Id = :id";
        $req = $conn->prepare($reqPrep);
        $req->bindParam(':id', $monId);
        $req->execute();
        $monProfil = $req->fetch();

        $amiDejaPresent = false;
        $amiAjoute = false;

        // Vérifier si l'ami est déjà ajouté
        for ($i = 1; $i <= 10; $i++) {
            if ($monProfil['Ami'.$i] == $idAmi) {
                $amiDejaPresent = true;
                break;
            }
        }

        if ($amiDejaPresent) {
            echo "<p>Cet ami est déjà dans votre liste.</p>";
        } else {
            // Trouver la première colonne AmiX vide
            for ($i = 1; $i <=10; $i++) {
                if ($monProfil['Ami'.$i] == NULL) {
                    $colonne = 'Ami'.$i;
                    $updateReq = "UPDATE profil SET $colonne = :idAmi WHERE Id = :monId";
                    $update = $conn->prepare($updateReq);
                    $update->bindParam(':idAmi', $idAmi);
                    $update->bindParam(':monId', $monId);
                    $update->execute();
                    $amiAjoute = true;
                    echo "<p>Ami ajouté avec succès !</p>";
                    break;
                }
            }

            if (!$amiAjoute) {
                echo "<p>Vous avez déjà 10 amis !</p>";
            }
        }
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}
	
?>