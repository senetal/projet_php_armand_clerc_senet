<?php

include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
require_once('../Modele/User.class.php');

session_start();
$imagePath = "../Modele/data/images/";

$limitPerPage = 8;
$max = $dao->numberOfProducts();

if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}

//Recupere le nom de la personne
if(isset($user)){
  $name = $user->name;
}

//Gestion des pages
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

//gestion des tris par prix
if (isset($_GET['choix_prix'])) {
  $triprix = $_GET['choix_prix'];
}
else{
  $triprix = "tous";
}

//les article a afficher par page
$nb = $page*$limitPerPage;


//gestion des tris par catégories
if(isset($_GET['choix_categorie'])){
  $category = $_GET['choix_categorie'];
  if ($category == "Toutes catégories"){
    $products = $dao->getPage($nb,$limitPerPage,$triprix);
  }else{
    $products = $dao->getPageCategorie($nb,$limitPerPage,$category,$triprix);
  }
}
else{
  $category = "Toutes catégories";
  $products = $dao->getPage($nb,$limitPerPage,$triprix);
};

//Gestion de l'ajout au panier
if(isset($_GET['add'])){

  if(isset($name)){
  $ref = intval($_GET['add']);
  //Pour les test

  $dao->addPanier($name,$ref);
}else{
$err = "Vous devez dabore etre connecte avant de rajoute au panier ";
}
}

$categories = $dao->getCategory();

if(sizeof($products)<$limitPerPage){
  $pageSuivante = $page;
}else{
  $pageSuivante = $page+1;
}

//Calcule du numeraux des page suivant
if($page == 0){
  $pagePrecedente = 0;
}else{
  $pagePrecedente = $page -1;
}

$page = intval($page);

include '../Vue/Article.view.php';
?>
