<?php

include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
require_once('../Modele/User.class.php');

session_start();

$ok = true;
$path = "../Modele/data/images/";

if(isset($_POST['title'])&&isset($_POST['desc'])&&isset($_POST['prix'])&&isset($_FILES['fileToUpload'])){
$title = $_POST['title'];
$desc = $_POST['desc'];
$prix = $_POST['prix'];
$cat= $_POST['choix_categorie'];

//Fichier as mettre en ligne

$target_file = $path . basename($_FILES["fileToUpload"]["name"]);
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
$ok =false;
$err = "Ce fichier n'est pas une image ";
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
    $err = "Ficher tros lourd";
      $ok = false;
    }

    if($ext != "jpg" && $ext != "png" && $ext != "jpeg"
&& $ext != "gif" ) {
$err = "Votre fchier dois etre de type : jpg , png , jpeg ou gif ";
    $Ok = false;
}

}else{
  $ok = false;
}

if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];


    $name = $user->name;


}else{
  $ok = false;
  $err ="Vous devez etre conexte pour poste une offre";
}

if($ok){
  $maxRef = $dao->getMaxRef();
  $fileName = ($maxRef+1).".".$ext;
$target_file = $path.$fileName;
//Si il ny as pas eu de pbr
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //Insere dans la base de donne
  $newRef = ($maxRef+1);
  $dao->insertNewProducts($newRef,$title,$prix,$fileName,$desc,$cat,$name);

}else{

  $err = "Une erreur est survenue merci de bien vouloir recomence";

}

}else if(isset($err)){
  echo $err;
}


//Gestion des diferente categorie disponible

$categories = $dao->getCategory();



include '../Vue/Proposition.view.php';
 ?>
