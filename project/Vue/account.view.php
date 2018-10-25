<?php
require_once('../Modele/User.class.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['user'])){
  $usr = $_SESSION['user'];
}

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Compte</title>
  </head>
  <body>
    <?php include('../Vue/header.php')?>

    <?php include('../Vue/accountmenu.php') ?>

    <div class='account'>

      Login :
      <input type="text" name="name" value="<?= $usr->name ?>" readonly><br>
      Mot de passe :
      <input type="password" name="password" value="<?= $usr->password ?>" readonly><br>
      Mail :
      <input type="mail" name="mail" value="<?= $usr->mail ?>" readonly><br>
      Telephone :
      <input type="text" name="tel" value="<?= $usr->tel ?>" readonly><br>
      Addresse :
      <input type="text" name="address" value="<?= $usr->address ?>" readonly><br>

    </div>

    <a href='../Controleur/disconnect.ctrl.php'><button type="button">Se deconnecter</button></a>

  </body>
</html>
