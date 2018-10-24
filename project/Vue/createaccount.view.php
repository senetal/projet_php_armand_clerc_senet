<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Creer un compte</title>
  </head>
  <body>
    <form class="createaccount" action="../Controleur/account.ctrl.php" method="post">
      <?php if (isset($_GET['err'])) {echo "<p>Les mots de passe sont différents, veuillez réessayer</p>";} ?>
      <label for="pseudo">Pseudo:</label>
      <input type="text" name="pseudo" value="" maxlength="64" autofocus required><br>
      <label for="password">Mot de passe:</label>
      <input type="password" name="password" value="" maxlength="64" required><br>
      <label for="password2">Confirmer mot de passe:</label>
      <input type="password" name="password2" value="" maxlength="64" required><br>
      <label for="mail">Mail:</label>
      <input type="email" name="mail" value=""><br>
      <label for="tel">Telephone:</label>
      <input type="text" name="tel" value="" maxlength="10" required><br>
      <label for="address">Adresse:</label>
      <input type="text" name="address" value="" maxlength="256" required><br>

      <input type="submit" name="submit" value="Creer le compte">
    </form>
  </body>
</html>
