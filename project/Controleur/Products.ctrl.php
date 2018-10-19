<?php

include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
$imagePath = "../Modele/data/images/";

$limitPerPage = 3;
if(isset($_GET['category'])){


}else{

if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 0;
}

//cb as aficher
$nb = $page*$limitPerPage;
//$products = $dao->firstProducts($limitPerPage);
$products = $dao->getPage($nb,$limitPerPage);
};

include '../Vue/Article.view.php';

 ?>
