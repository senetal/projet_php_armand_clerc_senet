<?php
session_start();
include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
$imagePath = "../Modele/data/images/";

$limitPerPage = 3;
$max = 6;
//Gestion des page
if(isset($_GET['category'])){


}else{

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 0;
  }

  if($page<0){
    $page = 0;
  }elseif($page>($max/$limitPerPage)-1){
    $page = ($max/$limitPerPage)-1;
  }

  //cb as aficher
  $nb = $page*$limitPerPage;
  //$products = $dao->firstProducts($limitPerPage);
  $products = $dao->getPage($nb,$limitPerPage);
};
//Gestion de l'ajout au panier

if(isset($_GET['add'])){

  $ref = intval($_GET['add']);
  //Pour les test
  $name = "clercma";

  $dao->addPanier($name,$ref);


}

include '../Vue/Article.view.php';

?>
