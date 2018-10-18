<?php

include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
$imagePath = "../Modele/data/images";

$limitPerPage = 3;
if(isset($_GET['category'])){


}else{

$products = $dao->firstProducts($limitPerPage);
};

include '../Vue/Article.view.php';

 ?>
