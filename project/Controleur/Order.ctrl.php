<?php

include '../Modele/DAO.class.php';
include '../Modele/Products.class.php';

session_start();

//Verifie que la session est bien en cour
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}

if(isset($user)){
  $name = $user->name;
}


if(isset($name)){
if(isset($_GET['valide'])){
  //Si il as clique sur le bouton valide alors la command est passe est on enelve les produis
  $command = $dao->removeProduisPanier($name);
}
//On lui affice les produis commande
$tab = $dao->getProduisPanier($name);
}
//var_dump($tab);

include '../Vue/Order.view.php';

 ?>
