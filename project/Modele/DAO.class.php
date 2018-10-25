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

// tableau des catégories
function getCategory(){
  $req = "SELECT * from category";
  $query =($this->db)->query($req);
  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
}

// tableau des produits non triés
function getPage(int $page,int $n,$triprix) : array{
  //$req = "SELECT * from Products ORDER BY ref LIMIT $page,$n";
  //$query = ($this->db)->query($req);
  if ($triprix == "croissant"){
    $req = "SELECT * from Products ORDER BY price LIMIT :page,:n";
  }
  elseif ($triprix == "decroissant") {
    $req = "SELECT * from Products ORDER BY price desc LIMIT :page,:n";
  }
  else{
    $req = "SELECT * from Products ORDER BY ref LIMIT :page,:n";
  }
  $query =($this->db)->prepare($req);
  $query->execute(array(
	'page' => htmlspecialchars($page),
	'n' => htmlspecialchars($n)
	));
  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
}

// tableau des produits triés par catégorie
function getPageCategorie(int $page,int $n,$categorie,$triprix) : array{
  if ($triprix == "croissant"){
    $req = "SELECT * from Products ORDER BY price LIMIT :page,:n";
  }
  elseif ($triprix == "decroissant") {
    $req = "SELECT * from Products ORDER BY price desc LIMIT :page,:n";
  }
  else{
    $req = "SELECT * from Products ORDER BY ref LIMIT :page,:n";
  }
  $req = "SELECT * from Products WHERE category=:category ORDER BY ref LIMIT :page,:n";
  $query =($this->db)->prepare($req);
  $query->execute(array(
  'page' => htmlspecialchars($page),
  'n' => $n,
  'category' =>$categorie
  ));
  var_dump($query);
  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  var_dump($tab);
  return $tab;
}



//Pense as gere le cas de multiple ajout avec des triger
function addPanier(string $name ,int $ref){
  //$req = "INSERT INTO panier Values ($name,$ref,0)";
  $nb = 0;
  /*
    $req = "Select count(*) from panier where name=:name and ref =:ref";
  $prep = ($this->db)->prepare($req);



    $nb = $prep->execute(array(
    'name' => $name,
    'ref' => $ref
    ));
  */

  $req = "Select count from panier where name='$name' and ref =$ref";
  $query = ($this->db)->query($req);
  $nb = $query->fetch();
  $nb = intval($nb[0]);
  //var_dump($req);
  var_dump($nb);

  if($nb==0){
    $req = "INSERT INTO panier Values(:name,:ref,1)";
    $prep = ($this->db)->prepare($req);


  $query = $prep->execute(array(
	'name' => htmlspecialchars($name),
	'ref' => htmlspecialchars($ref)
	));

}else{


    $req = "Update panier SET count = ((Select count from panier where name =:name and ref = :ref)+1) where name =:name and ref =:ref";

    $prep = ($this->db)->prepare($req);


  $query = $prep->execute(array(
  'name' => htmlspecialchars($name),
  'ref' => htmlspecialchars($ref)
  ));

}
}

function getProduisPanier(string $name):array{



$req ="SELECT p.*,q.count from products as p , panier as q WHERE q.name =:name and q.ref = p.ref";
//$query = ($this->db)->query($req);
$query =($this->db)->prepare($req);

$query->execute(array(
'name' => htmlspecialchars($name)
));

  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'ProductsPanier');

return $tab;

}


function removeProduisPanier(string $name){
  $req = "DELETE FROM panier WHERE name = :name";
  $prep = ($this->db)->prepare($req);


    $query = $prep->execute(array(
    'name' => htmlspecialchars($name)
    ));

    return $query;

}

function getUser(string $name, string $password){
	$req="SELECT * from user where name='$name' and password='$password'";
	$query = ($this->db)->query($req);
	$tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
  if (isset($tab[0]))
  return $tab[0];
  return NULL;
}

function userAlreadyExists(string $name):bool{
	$req="SELECT * from user where name='$name'";
	$query = ($this->db)->query($req);
	$tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
  return isset($tab[0]);
}

  public function createUser(string $pseudo, string $password, string $mail, string $tel, string $address):User{
    $req = "insert into user values(:pseudo,:password,:mail,:tel,:address)";
    $query =($this->db)->prepare($req);

    $query->execute(array(
    'pseudo' => $pseudo,
    'password' => $password,
    'mail' => $mail,
    'tel' => $tel,
    'address' => $address,
    ));
	  return new User($pseudo,$password,$mail,$tel,$address);
  }

}

 ?>
