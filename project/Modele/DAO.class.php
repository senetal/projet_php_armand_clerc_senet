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
