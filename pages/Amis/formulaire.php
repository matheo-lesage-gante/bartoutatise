<?php
session_start();

// Fonctions pour valider les champs
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
                echo "<p style='color:darkred; font-weight:bold;'>Cet ami est déjà dans votre liste.</p>";
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
                        header('location:amis.php');
                        $amiAjoute = true;
                        die();
                        break;
                    }
                }

                if (!$amiAjoute) {
                    echo "<p style='color:darkred; font-weight:bold;'>Vous avez déjà 10 amis !</p>";
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

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f5e1;
        color: #4a703c; /* Vert gaulois */
        margin: 0;
        padding: 20px;
    }
    h2 {
        font-family: 'Papyrus', cursive, serif;
        font-size: 2.5rem;
        color: #4a703c;
        text-shadow: 2px 2px #b79f57;
        border-bottom: 3px solid #b79f57;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }
    p {
        font-size: 1.1rem;
        margin: 10px 0;
    }
    input.send_button {
        background-color: #4a703c;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    input.send_button:hover {
        background-color: #3b552d;
    }
    input.send_button:active {
        background-color: #2c3e1e;
    }
    input.send_button:focus {
        outline: none;
        box-shadow: 0 0 5px #b79f57;
    }
    input[type="button"] {
        margin-top: 15px;
        background-color: #b79f57;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    input[type="button"]:hover {
        background-color: #9b8745;
    }
    input[type="button"]:active {
        background-color: #7a6d33;
    }
</style>
