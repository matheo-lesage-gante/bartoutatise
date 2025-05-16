<!DOCTYPE html5>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../css/log.css">
  </head>
  <body>
    <?php include 'header.php'?>
    <form method="post" action="form.php">
      <div class ="block">
      <h2>Une place au village ?</h2>
      <div >
      <label for="mail">Mail :</label>
        <input name="mail" class="text" type="email" placeholder="Email" pattern="/^[a-z.-]+@[a-z.]/" required="required">
      </div>
      <br>
      <div >
        <label for="pseudo">Pseudo :</label>
        <input name="pseudo" class="text" type="text" placeholder="Username" minlength="3" maxlength="40" required="required">
      </div>
      <br>
      <div >
        <label for="mdp">Mots de passe :</label>
        <input name="mdp" class="text" type="password" placeholder="Password" minlength="3" maxlength="40" required="required">
      </div>
      <br>
      <div >
        <label for="confirm">Confirmer le mot de passe :</label>
        <input name="confirm" class="text" type="password" placeholder="Confirm Password" minlength="3" maxlength="40" required="required">
      </div>
      <br>
      <div >
        
        <input name="valider" class="send_button" type="submit" value="Sign up">
      </div>
    </div>
    </form>

    <div class="block2">
      <p class="text"> Tu as déjà ta place ?</p>
      <input type="button" value="Rejoint le village !" onclick="window.location.href='login.php'" class="send_button">
      
    </div>
  </body>
</html>