<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2;URL=accueil.php">

    <link rel="stylesheet" href="../css/style.css">
    <title>Bar'toutatise | Fail</title>
</head>
<body>
    <?php include("header.php")?>


    <div class="main-main">
        <div class="main__container">
            <h1 class="main__title">
                <?php 
                $err = "";
                if(isset($_GET["err"]))
                    $err = $_GET["err"];
                if($err == "falsePsdPswd"){
                    echo " Mots de passe ou pseudo incorrect.";
                } else {
                    if($err == "pseudoUsed") {
                        echo "Pseudo déjà utilisé. Veuillez en choisir un autre.";
                    } else {
                        if($err == "falsePswd")
                            echo "Les mots de passe ne correspondent pas.";
                    }
                }
                ?>
            </h1>


        </div>
    </div>

    
    <?php include("footer.php")?>
</body>
</html>
