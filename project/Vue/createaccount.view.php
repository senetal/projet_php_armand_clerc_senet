<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Créer un compte</title>
  </head>
  <body>
    <?php include('header.php'); ?><br>
    <form class="createaccount" action="../Controleur/account.ctrl.php" method="post">
      <?php if(isset($err)) echo $err; ?>
      <label for="pseudo">Pseudo* :</label>
      <input type="text" name="pseudo" value="" maxlength="64" autofocus required><br>
      <label for="password">Mot de passe* :</label>
      <input type="password" name="password" value="" maxlength="64" required><br>
      <label for="password2">Confirmer mot de passe* :</label>
      <input type="password" name="password2" value="" maxlength="64" required><br>
      <label for="mail">Mail* :</label>
      <input type="email" name="mail" value=""><br>
      <label for="tel">Téléphone* :</label>
      <input type="text" name="tel" value="" maxlength="10" required><br>
      <label for="address">Adresse postale *:</label>
      <input type="text" name="address" value="" maxlength="256" required><br>

      <input type="submit" name="submit" value="Creer le compte">
    </form>
    <p>Vous possédez un compte ? Connectez-vous ici :</p>
    <a href='../Vue/login.view.php'><button type="button">Se connecter</button></a>
  </body>
</html>
