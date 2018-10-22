<?php
  require_once('../Modele/User.class.php');
  require_once('../Modele/DAO.class.php');

  session_start();

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
    } else {
      $_SESSION['user']=createUser($name,$password,$mail,$tel,$address)
    }
  else {
      $usr=getUser($name,$password);
      if ($usr!=NULL){
        $_SESSION['user']=$usr;
      } else {
        //Faudrait retourner à la page d'avant mais j'vois pas comment 
      }
  }


  }


  include('../Vue/account.view.php');
?>
