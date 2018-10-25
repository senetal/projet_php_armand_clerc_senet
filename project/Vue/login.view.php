<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
<<<<<<< HEAD
    <?php include('header.php'); ?><br>
=======
        <?php include('../Vue/header.php')?>
>>>>>>> 5518fb98d030c8a541df4a83cc17ff0f7de3f581
    <form class="login" action="../Controleur/account.ctrl.php" method="post">
      <?php if(isset($err)) echo $err; ?>
      <label for="pseudo">Pseudo:</label>
      <input type="text" name="pseudo" value="" maxlength="64" autofocus required><br>
      <label for="password">Mot de passe:</label>
      <input type="password" name="password" value="" maxlength="64" required><br>
      <input type="submit" name="submit" value="Se connecter">
    </form>
    <p>Pas de compte ? Creez-en un ici :</p>
    <a href='createaccount.view.php'><button type="button">Creer un compte</button></a>
  </body>
</html>
