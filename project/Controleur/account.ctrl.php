<?php
  require_once('../Modele/User.class.php');
  require_once('../Modele/UserDAO.class.php');

  $users=new UserDAO();

  foreach($_POST as $key => $value){
    switch($key) {
      case "pseudo":
      $pseudo=$value;
      break;
      case "password":
      $password=$value;
      break;
      case "password2":
      $password2=$value;
      break;
      case "mail":
      $mail=$value;
      break;
      case "tel":
      $tel=$value;
      break;
      case "password":
      $address=$value;
      break;
    }
  }

  if (isset($password2)) {
    if ($password!=$password2){
      $error = 'Mots de passe différents, veuillez réessayer.';
    }


  }


  include('../Vue/account.view.php');
?>
