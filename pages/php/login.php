<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Bar'toutatise</h1>  
    <form method="post" action="form.php">
        <div class="formulaire">
            <h2>Sign in</h2>
            <div>
                <input name="pseudo" type="text" placeholder="Username" <?php if(isset($_COOKIE['pseudo'])){echo 'value="'.$_COOKIE['pseudo'].'" ';} ?>minlength="3" maxlength="40" required="required">
            </div>
            <div>
                <input name="mdp" type="password" placeholder="Password" <?php if(isset($_COOKIE['password'])){echo 'value="'.$_COOKIE['password'].'" ';} ?> minlength="3" maxlength="40" required="required">
            </div>
            <div>
                <input name="connecter" type="submit" value="Sign in">
            </div>
            <div>
                <a href="../php/logup.php">Sign up</a>
            </div>
        </div>
    </form>
    <br>
</body>
</html>