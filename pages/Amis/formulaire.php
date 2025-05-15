<?php

session_start(); // à déplacer en haut du script !

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement si c’est le bouton 'Envoyer'
    if (isset($_POST['Envoyer'])) {
        if (empty($_POST['id'])) {
            header('location:amis.php');
            die();
        }

        $vID = nettoyer_donnees($_POST['id']);

        try {
            require("connexion.php");
            $reqPrep = "SELECT * FROM profil WHERE Id = :id";
            $req = $conn->prepare($reqPrep);
            $req->bindParam(':id', $vID);
            $req->execute();
            $resultat = $req->fetch();
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }

        if (!valider_ID($vID)) {
            header('location:amis.php');
            die();
        } else if ($resultat == false) {
            echo "<h2>L'utilisateur n'existe pas</h2>";
        } else {
            echo "<h2>Pseudo : " . $resultat['Pseudo'] . "</h2>";
            echo "<p>ID : " . $resultat['Id'] . "</p>";
            for ($index = 1; $index < 11; $index++) {
                if ($resultat['Ami'.$index] != NULL) {
                    echo "<p>Ami".$index." : " . $resultat['Ami'.$index] . "</p>";
                }
            }

            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='id_ami' value='" . $resultat['Id'] . "'>";
            echo "<input type='submit' name='Ajouter' value='Ajouter un ami' class='send_button'>";
            echo "</form>";

            echo "<input type='button' value='Retour' onclick=\"window.location.href='amis.php'\" class='send_button'>";
        }
    }

    // Traitement si c’est le bouton 'Ajouter'
    if (isset($_POST['Ajouter'])) {
        $idAmi = nettoyer_donnees($_POST['id_ami']);
        $monId = $_SESSION['Id'];

        try {
            require("connexion.php"); // s’assurer que la connexion est faite ici aussi

            $reqPrep = "SELECT * FROM profil WHERE Id = :id";
            $req = $conn->prepare($reqPrep);
            $req->bindParam(':id', $monId);
            $req->execute();
            $monProfil = $req->fetch();

            $amiDejaPresent = false;
            $amiAjoute = false;

            for ($i = 1; $i <= 10; $i++) {
                if ($monProfil['Ami'.$i] == $idAmi) {
                    $amiDejaPresent = true;
                    break;
                }
            }

            if ($amiDejaPresent) {
                echo "<p>Cet ami est déjà dans votre liste.</p>";
                echo "<br><input type='button' value='Retour' onclick=\"window.location.href='amis.php'\" class='send_button'>";
            } else {
                for ($i = 1; $i <=10; $i++) {
                    if ($monProfil['Ami'.$i] == NULL) {
                        $colonne = 'Ami'.$i;
                        $updateReq = "UPDATE profil SET $colonne = :idAmi WHERE Id = :monId";
                        $update = $conn->prepare($updateReq);
                        $update->bindParam(':idAmi', $idAmi);
                        $update->bindParam(':monId', $monId);
                        $update->execute();
                        echo "<p>Ami ajouté avec succès !</p>";
                        $amiAjoute = true;
                        echo "<br><input type='button' value='Retour' onclick=\"window.location.href='amis.php'\" class='send_button'>";
                        die();
                        break;
                    }
                }

                if (!$amiAjoute) {
                    echo "<p>Vous avez déjà 10 amis !</p>";
                    echo "<br><input type='button' value='Retour' onclick=\"window.location.href='amis.php'\" class='send_button'>";
                }
            }
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
} else {
    header('location:amis.php');
    die();
}
?>