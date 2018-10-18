<?php


$dao = new DAO();

class DAO{

public $db;
public $source = 'sqlite:../Modele/data/data.db';

function __construct() {



  try{
    $this->db= new PDO($this->source);
  }catch(PDOException $e){
    die("erreur de connexion:".$e->getMessage()." \n $this->db \n");
  }
}


function getAllCategory() : array {

  $req = "SELECT * FROM category";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Category');



  return $tab;
}



// Accès aux n premiers articles
// Cette méthode retourne un tableau contenant les n permier articles de
// la base sous la forme d'objets de la classe Article.
function firstProducts(int $n) : array {
  $req = "SELECT * FROM products ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');



  return $tab;
}

// Acces au n articles à partir de la reférence $ref
// Cette méthode retourne un tableau contenant n  articles de
// la base sous la forme d'objets de la classe Article.
function getN(int $ref,int $n) : array {
  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////

  $req = "SELECT * FROM Products WHERE ref >=$ref ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');



  return $tab;


}

// Acces à la référence qui suit la référence $ref dans l'ordre des références
function next(int $ref) : int {
  if($ref!=0){
    $req = "SELECT ref FROM Products WHERE ref >$ref ORDER BY ref limit 1 ";

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

  $req = "SELECT * from Products WHERE ref<$ref ORDER BY ref DESC LIMIT $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');



  return array_reverse($tab);


}



function getCat(int $id): Categorie {


  $req = "SELECT * from Category WHERE id = $id  ";

  $querry = ($this->db)->query($req);
  $cat = $querry->fetch(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Category');


  return $cat;
}




function getNCateg(int $ref,int $n,string $categorie) : array {

  $req = "SELECT * FROM Products WHERE ref >=$ref and category =$categorie ORDER BY ref limit $n ";

  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');



  return $tab;

}


}

 ?>
