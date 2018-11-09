<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php include('header.php'); ?><br>
    <form class="login" action="../Controleur/account.ctrl.php" method="post">
      <?php if(isset($err)) echo $err; ?>
      <label for="pseudo">Pseudo:</label>
      <input type="text" name="pseudo" value="" maxlength="64" autofocus required><br>
      <label for="password">Mot de passe:</label>
      <input type="password" name="password" value="" maxlength="64" required><br>
      <input type="submit" name="submit" value="Se connecter">
    </form>
    <p>Pas de compte ? Créez-en un ici :</p>
    <a href='../Vue/createaccount.view.php'><button type="button">Créer un compte</button></a>

      <?php include('footer.php')?>
  </body>
</html>
