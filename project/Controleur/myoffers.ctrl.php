<?php

include '../Modele/DAO.class.php';
include '../Modele/Products.class.php';

session_start();

if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}

if (isset($_GET['rm'])){
  $dao->removeOffre($_GET['rm']);
}

if(isset($user)){
  $name = $user->name;
}

if(isset($name)){
  $tab = $dao->getOffre($name);
}

include '../Vue/myoffers.view.php';

 ?>
