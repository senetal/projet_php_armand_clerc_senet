<?php
session_start();
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
      header('Location : ../Vue/createaccount.view.php&err=badpw');
      exit();
    } else {
      $_SESSION['user']=createUser($name,$password,$mail,$tel,$address);
    }
  } else {
      $usr=$dao->getUser($name,$password);
      if ($usr!=NULL){
        $_SESSION['user']=$usr;
      } else {
        header('Location : ../Vue/login.view.php&err=badpw');
      exit();
      }
  }


  include('../Vue/account.view.php');
?>
