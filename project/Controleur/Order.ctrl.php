<?php

include '../Modele/DAO.class.php';
include '../Modele/Products.class.php';

session_start();

if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}

if(isset($user)){
  $name = $user->name;
}

if(isset($name)){
if(isset($_GET['valide'])){
  $command = $dao->removeProduisPanier($name);
}
$tab = $dao->getProduisPanier($name);
}
//var_dump($tab);

include '../Vue/Order.view.php';

 ?>
