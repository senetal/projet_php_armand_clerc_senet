<?php
session_start();
include '../Modele/DAO.class.php';
include '../Modele/Products.class.php';
$name = 'clercma';


if(isset($_GET['valide'])){
  $command = $dao->removeProduisPanier($name);
}
$tab = $dao->getProduisPanier($name);

//var_dump($tab);

include '../Vue/Order.view.php';

 ?>
