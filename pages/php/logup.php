<!DOCTYPE html5>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
    <?php include 'header.php'?>
    <form method="post" action="form.php">
      <div class ="formulaire2">
      <h2>Sign up</h2>
      <div >
        <input name="mail" type="email" placeholder="Email" pattern="/^[a-z.-]+@[a-z.]/" required="required">
      </div>
      <div >
        <input name="pseudo" type="text" placeholder="Username" minlength="3" maxlength="40" required="required">
      </div>
      <div >
        <input name="mdp" type="password" placeholder="Password" minlength="3" maxlength="40" required="required">
      </div>
      <div >
        <input name="confirm" type="password" placeholder="Confirm Password" minlength="3" maxlength="40" required="required">
      </div>
      <div >
        <input name="valider" type="submit" value="Sign up">
      </div>
    </div>
    </form>
    <br>
    <div class="formulaire2">
      <h2>Already have an account?</h2>
      <input type="button" value="Login" onclick="window.location.href='login.php'" class="send_button">
    </div>
  </body>
</html>