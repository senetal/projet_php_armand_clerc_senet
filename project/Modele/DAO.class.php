<?php

require_once('User.class.php');

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
//////////////////////////////////////////////////////////////

function getPage(int $page,int $n) : array{
  $req = "SELECT * from Products ORDER BY ref LIMIT $page,$n";
  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
}
//As reaiore avec un perpare
function getPageCategorie(int $page,int $n,$categorie) : array{
  $req = "SELECT * from Products WHERE category='$categorie' ORDER BY ref LIMIT $page,$n";
  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
}



//Pense as gere le cas de multiple ajout avec des triger
function addPanier(string $name ,int $ref){
  //$req = "INSERT INTO panier Values ($name,$ref,0)";
  $req = "INSERT INTO panier Values(:name,:ref,1)";
$prep = ($this->db)->prepare($req);


  $querry = $prep->execute(array(
	'name' => $name,
	'ref' => $ref
	));


echo (" DAO Class l 157 : $req");
}

function getProduisPanier(string $name):array{

$req ="SELECT p.*,q.count from products as p , panier as q WHERE q.name ='$name' and q.ref = p.ref";
$querry = ($this->db)->query($req);
$tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'ProductsPanier');
return $tab;
}

function getUser(string $name, string $password):User{
	$req="select * from user where name=$name and password=$password";
	$query = ($this->db)->query($req);
	$tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
return $tab[0];
}

  public function create(string $pseudo, string $password, string $mail, string $tel, string $address):User{
    ($this->db)->query("insert into user values($pseudo,$password,$mail,$tel,$address)");
	  return new User($pseudo,$password,$mail,$tel,$address);
  }

}

 ?>
