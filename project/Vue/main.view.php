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
      <link rel="stylesheet" href="../Vue/css/main.css">
  <div class="main" >


    <h1>Accueil</h1>


    <div class="main">
      <h2>Bienvenue sur Lebonchat.fr ! </h2><br>

      <article class="intro">
        <p>Vous voulez de la compagnie ? Ne cherchez plus, trouvez ici le chat qui vous convient !</p>
      </article>


      <a href="../Controleur/Products.ctrl.php"><button type="button" class="boutton" class="consult" name="button">Consultez nos offres !</button></a>

      <br><br><br><br>
      <p>Connectez-vous ici :</p>
      <a href='../Vue/login.view.php'><button type="button" class="boutton">Se connecter</button></a>
      <p>Pas encore membre ? Inscrivez-vous ici :</p>
      <a href='../Vue/createaccount.view.php'><button class="boutton" type="button">Créer un compte</button></a>
    </div>
    

    <footer>
      <?php include('footer.php')?>
    </footer>
    </div>
  </body>
</html>
