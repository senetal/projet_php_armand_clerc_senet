<?php
session_start();
  require_once('../Modele/User.class.php');
  require_once('../Modele/DAO.class.php');

  $dao=new DAO();

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
      case "address":
      $address=$value;
      break;
    }
  }

  if (isset($password2)) {
    if ($password!=$password2){
      header('Location : ../Vue/createaccount.view.php&err=badpw');
      exit();
    } else {
      $_SESSION['user']=$dao->createUser($pseudo,$password,$mail,$tel,$address);
    }
  } else {
      $usr=$dao->getUser($pseudo,$password);
      if ($usr!=NULL){
        $_SESSION['user']=$usr;
      } else {
        header('Location : ../Vue/login.view.php&err=badpw');
      exit();
      }
  }

  include('../Vue/account.view.php');
?>
