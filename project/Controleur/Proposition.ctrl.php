<?php

include '../Modele/Products.class.php';
include '../Modele/DAO.class.php';
require_once('../Modele/User.class.php');

session_start();

//Par defaut il n'y as pas d'erreur
$ok = true;
$path = "../Modele/data/images/";

if(isset($_POST['title'])&&isset($_POST['desc'])&&isset($_POST['prix'])&&isset($_FILES['fileToUpload'])){
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $prix = $_POST['prix'];
  $cat= $_POST['choix_categorie'];

  //Fichier as mettre en ligne

  $target_file = $path . basename($_FILES["fileToUpload"]["name"]);

  //Extention du fichier
  $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  //Verifi que cela est une image , si ce n'est pas une image elle revois faux
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check === false) {
    $ok =false;
    $err = "Ce fichier n'est pas une image ";
  }

  //Ne pas metre en ligne une image tros lourde
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $err = "Ficher tros lourd";
    $ok = false;
  }

  //Verifi que le type de l'image est corect
  if(!($ext == "jpg" || $ext == "png" || $ext == "jpeg"|| $ext == "gif") ) {
    $err = "Votre fchier dois etre de type : jpg , png , jpeg ou gif ";
    //Si ce nest pas une image valide on annule
    $ok = false;
  }

}else{
  //Si il n'y as pas de fichier uplode ou des informations manquante
  $ok = false;
}

//Verifi que la session en cour exite
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];

  $name = $user->name;

}else{
  $ok = false;
  $err ="Vous devez etre conexte pour poste une offre";
}

//Si cela est valide on met en ligne la propostion
if($ok){
  $maxRef = $dao->getMaxRef();
  $fileName = ($maxRef+1).".".$ext;
  $target_file = $path.$fileName;
  //Si il ny as pas eu de problèmes
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //Insere dans la base de donnee
    $newRef = ($maxRef+1);
    $resulta = $dao->insertNewProducts($newRef,$title,$prix,$fileName,$desc,$cat,$name);

if(!$resulta){
    $err = "Une erreur est survenue merci de bien vouloir recomence";
}

  }else{
    //Si il y a eu un problème
    $err = "Une erreur est survenue merci de bien vouloir recomence";
  }

}


//Gestion des differentes categories disponible

$categories = $dao->getCategory();



include '../Vue/Proposition.view.php';
?>
