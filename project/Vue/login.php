<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form class="login" action="main.html" method="post">
      <label for="pseudo">Pseudo:</label>
      <input type="text" name="pseudo" value="" maxlength="64" autofocus required><br>
      <label for="password">Mot de passe:</label>
      <input type="password" name="password" value="" maxlength="64" required><br>
      <input type="submit" name="submit" value="Se connecter">
    </form>
  </body>
</html>
