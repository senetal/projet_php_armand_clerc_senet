<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
  </head>
  <body >
    <header>
      <?php include('header.php')?>
    </header>
  <div class="main">


    <h1>Accueil</h1>

    <div class="main">
      <h2>Bienvenue sur Lebonchat.fr ! </h2><br>
      <p>Vous devez vous connecter pour pouvoir continuer sur notre site :</p>
      <a href='../Vue/login.view.php'><button type="button">Se connecter</button></a>
      <p>Pas encore membre ? Inscrivez-vous ici :</p>
      <a href='../Vue/createaccount.view.php'><button type="button">Creer un compte</button></a>
    </div>

    <footer>
      <?php include('footer.php')?>
    </footer>
    </div>
  </body>
</html>
