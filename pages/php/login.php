<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/log.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <form method="post" action="form.php">
        <div class="block">
            <h2>Rejoint le village</h2>
            <div>
                <label for="id">Pseudo :</label>
                <input name="pseudo" type="text" placeholder="Username" <?php if(isset($_COOKIE['pseudo'])){echo 'value="'.$_COOKIE['pseudo'].'" ';} ?>minlength="3" maxlength="40" required="required">
            </div>
            <br>
            <div>
                <label for="id">Mots de passe :</label>
                <input name="mdp" class="text" type="password" placeholder="Password" <?php if(isset($_COOKIE['password'])){echo 'value="'.$_COOKIE['password'].'" ';} ?> minlength="3" maxlength="40" required="required">
            </div>
            <br>
            <div>
                <input name="connecter" type="submit" class="send_button" value="Sign in">
            </div>
            <br>
            <div>
                <a href="../php/logup.php">Sign up</a>
            </div>

        </div>
    </form>
    <br>
</body>
</html>