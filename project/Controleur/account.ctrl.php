<?php

  require_once('../Modele/User.class.php');
  require_once('../Modele/DAO.class.php');

  session_start();

  $dao=new DAO();
  $err="";

  foreach($_POST as $key => $value){
    switch($key) {
      case "pseudo":
      $pseudo=$value;
      break;
      case "password":
      $password=htmlspecialchars($value);
      break;
      case "password2":
      $password2=htmlspecialchars($value);
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
      $err="<p>Les mots de passe sont différents, veuillez réessayer.</p>";
      include('../Vue/createaccount.view.php');
      exit();
    } else {
      $_SESSION['user']=$dao->createUser($pseudo,$password,$mail,$tel,$address);
    }
  } else {
      $usr=$dao->getUser($pseudo,$password);
      if ($usr!=NULL){

        $_SESSION['user']=$usr;
        $name = $pseudo;
      } else {
        $err="<p>Mot de passe incorrect, veuillez réessayer.</p>";
        include('../Vue/login.view.php');
        exit();
      }
  }

  include('../Vue/account.view.php');
?>
