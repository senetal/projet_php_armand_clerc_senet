<?php


$DAO = new DAO();

class DAO{

$db;
$source = 'sqlite data.db';

function __construct() {


  try{
    $this->db= new PDO($this->source);
  }catch(PDOException $e){
    die("erreur de connexion:".$e->getMessage()." \n $this->db \n");
  }
}


function getAllCat() : array {

  $req = "SELECT * FROM categorie";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'categorie');



  return $tab;
}



// Accès aux n premiers articles
// Cette méthode retourne un tableau contenant les n permier articles de
// la base sous la forme d'objets de la classe Article.
function firstN(int $n) : array {
  $req = "SELECT * FROM article ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'article');



  return $tab;
}

// Acces au n articles à partir de la reférence $ref
// Cette méthode retourne un tableau contenant n  articles de
// la base sous la forme d'objets de la classe Article.
function getN(int $ref,int $n) : array {
  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////

  $req = "SELECT * FROM article WHERE ref >=$ref ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'article');



  return $tab;


}

// Acces à la référence qui suit la référence $ref dans l'ordre des références
function next(int $ref) : int {
  if($ref!=0){
    $req = "SELECT ref FROM article WHERE ref >$ref ORDER BY ref limit 1 ";

    $querry = ($this->db)->query($req);
    $tab = $querry->fetch();



    return intval($tab['ref']);
  }else{
    return 0;
  }
}

// Acces aux n articles qui précèdent de $n la référence $ref dans l'ordre des références
function prevN(int $ref,int $n): array {
  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////

  $req = "SELECT * from article WHERE ref<$ref ORDER BY ref DESC LIMIT $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'article');



  return array_reverse($tab);


}



function getCat(int $id): Categorie {


  $req = "SELECT * from categorie WHERE id = $id  ";

  $querry = ($this->db)->query($req);
  $cat = $querry->fetch(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'categorie');


  return $cat;
}




function getNCateg(int $ref,int $n,string $categorie) : array {

  $req = "SELECT * FROM article WHERE ref >=$ref and categorie =$categorie ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'article');



  return $tab;

}


}

 ?>
