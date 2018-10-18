<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
  </head>
  <body>
    <h1>Connexion</h1>
    <p>Adresse email</p>
    <input autofocus type="email" name="email" value=""/>
    <p>Mot de passe</p>
    <input autofocus type="text" name="mdp" value=""/>
    <input type="submit" name="boutton" value="test" />




    <input type="email" name="reponse" value="Oui"/>
    <input type="submit" name="reponse" value="Non"/>
    <input type="hidden" name="nom" value="<?= $nom ?>" />


    <p>Entrer une valeur :</p>
    <input autofocus type="number" name="in" value="<?= $in?>"> Celcuis égal
    <input readonly type="number" name="out" value="<?= $out?>"> Fahrenheit
    <input type="submit" name="action" value="Convertir">

  </body>
</html>
