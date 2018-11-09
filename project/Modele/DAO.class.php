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
    $req = "SELECT * from Products WHERE category=:category ORDER BY price LIMIT :page,:n";
  }
  elseif ($triprix == "decroissant") {
    $req = "SELECT * from Products WHERE category=:category ORDER BY price desc LIMIT :page,:n";
  }
  else{
    $req = "SELECT * from Products WHERE category=:category ORDER BY ref LIMIT :page,:n";
  }
  $query =($this->db)->prepare($req);
  $query->execute(array(
  'page' => htmlspecialchars($page),
  'n' => $n,
  'category' =>$categorie
  ));
  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
}



//Ajout au panier d'un produis pour un utilisateur donne
function addPanier(string $name ,int $ref){

  $nb = 0;

//Recupreation du nombre d'article que la perssone posste pour cette refence
  $req = "Select count from panier where name='$name' and ref =$ref";
  $query = ($this->db)->query($req);
  $nb = $query->fetch();
  $nb = intval($nb[0]);

  //Si elle n'as jamais ajoute ce produis on lui rajoute
  if($nb==0){
    $req = "INSERT INTO panier Values(:name,:ref,1)";
    $prep = ($this->db)->prepare($req);


  $query = $prep->execute(array(
	'name' => htmlspecialchars($name),
	'ref' => htmlspecialchars($ref)
	));

//Si elle as deja eu ce produis on incremete de 1
}else{


    $req = "Update panier SET count = ((Select count from panier where name =:name and ref = :ref)+1) where name =:name and ref =:ref";

    $prep = ($this->db)->prepare($req);


  $query = $prep->execute(array(
  'name' => htmlspecialchars($name),
  'ref' => htmlspecialchars($ref)
  ));

}
}

//Recupere tout les prodis d'une perssone pour un panner
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


//Enleve un produis dus pannier d'une perssone quand elle as commande
function removeProduisPanier(string $name){


  $req = "Select ref from panier where name =:name ";
  $prep = ($this->db)->prepare($req);


    $query = $prep->execute(array(
    'name' => htmlspecialchars($name)
    ));

//Je recupere un tableu de string
  $tabRef =  $prep->fetchAll();

  //Je le traduis en tableau de int
$tabInt = array();
foreach($tabRef as $k=>$v ){
  //Cela est une array je prend juste le premier ellement
$tabInt[] = intval($v[0]);
}

//On Transfome nos int en une longue string
$ref = implode("','", $tabInt);

//Et on extcute
//Ici on peux faire un querry car les donne son fiable (elle vien d'un select qui ne revois que des nombre) , pas besoin de prepare

//Pour le panier
  $req = "DELETE FROM panier WHERE ref in ('$ref') ";
$query = ($this->db)->query($req);

//Pour les produis
$req = "DELETE FROM products WHERE ref in ('$ref') ";
$query = ($this->db)->query($req);

    return $query;

}

//Toute les offre d'une perssone
function getOffre(string $owner):array{

$req ="SELECT * from products WHERE owner =:owner";
$query =($this->db)->prepare($req);

$query->execute(array(
'owner' => htmlspecialchars($owner)
));

  $tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'ProductsPanier');

return $tab;

}

//Enleve une offre
function removeOffre(string $name){
  $req = "DELETE FROM products WHERE name = :name";
  $prep = ($this->db)->prepare($req);

    $query = $prep->execute(array(
    'name' => htmlspecialchars($name)
    ));

    return $query;

}

//Recupere un utilisteur pour un nom et un mdp donne
function getUser(string $name, string $password){
	$req="SELECT * from user where name=:name and password=:password";
	$query = ($this->db)->query($req);

  $prep = ($this->db)->prepare($req);

    $query = $prep->execute(array(
    'name' => htmlspecialchars($name),
      'password' => htmlspecialchars($password),

    ));

	$tab = $prep->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
  if (isset($tab[0]))
  return $tab[0];
  return NULL;
}

//Verifie si un utilisteur exite deja
function userAlreadyExists(string $name):bool{
	$req="SELECT * from user where name=:name";


  $prep = ($this->db)->prepare($req);

    $query = $prep->execute(array(
    'name' => htmlspecialchars($name)
    ));

	$tab = $prep->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
  return isset($tab[0]);
}

//Cree un nouvelle user
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


//Numere de la reference maximale
  function getMaxRef(){
  $req = "Select max(ref) from products";
  $querry = ($this->db)->query($req);
  $res = $querry->fetch();

  return intval($res[0]);
}

//Nombre de produis total
function numberOfProducts(){
$req = "Select count(*) from products";
$querry = ($this->db)->query($req);
$res = $querry->fetch();

return intval($res[0]);
}

//Rajoute un nouveaux produis
function insertNewProducts(int $ref, string $title ,int $prix,string $path ,string $description ,string $categorie ,string $owner ){
  $req = "INSERT INTO products VALUES (:ref,:title,:prix,:path,:description,:categorie,:owner) ";
  $prep = ($this->db)->prepare($req);
    $query = $prep->execute(array(
    'ref' => htmlspecialchars($ref),
    'title' => htmlspecialchars($title),
    'prix' => htmlspecialchars($prix),
    'path' => htmlspecialchars($path),
    'description' => htmlspecialchars($description),
    'categorie' => htmlspecialchars($categorie),
    'owner' => htmlspecialchars($owner),

    ));
  
    return $query;
}


}



 ?>
