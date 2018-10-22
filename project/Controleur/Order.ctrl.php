<?php
session_start();
include '../Modele/DAO.class.php';
include '../Modele/Products.class.php';
$name = 'clercma';


//if($_GET[])
$tab = $dao->getProduisPanier($name);

//var_dump($tab);

include '../Vue/Order.view.php';

 ?>
