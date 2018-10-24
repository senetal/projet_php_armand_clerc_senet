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
  //$req = "SELECT * from Products ORDER BY ref LIMIT $page,$n";
  //$querry = ($this->db)->query($req);
  $req = "SELECT * from Products ORDER BY ref LIMIT :page,:n";
  $querry =($this->db)->prepare($req);
  $querry->execute(array(
	'page' => $page,
	'n' => $n
	));

  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
  return $tab;
  
}

//As reaiore avec un perpare
function getPageCategorie(int $page,int $n,$categorie) : array{
  $req = "SELECT * from Products WHERE category=':category' ORDER BY ref LIMIT :page,:n";
  $querry =($this->db)->prepare($req);
  $querry->execute(array(
  'page' => $page,
  'n' => $n,
  'category' =>$categorie
  ));
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');
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
  $querry = ($this->db)->query($req);
  $nb = $querry->fetch();
  $nb = intval($nb[0]);
  //var_dump($req);
  var_dump($nb);

  if($nb==0){
    $req = "INSERT INTO panier Values(:name,:ref,1)";
    $prep = ($this->db)->prepare($req);


    $querry = $prep->execute(array(
  	'name' => $name,
  	'ref' => $ref
  	));

    echo 'DAO CLass 78 INsert ';
  }else{


    $req = "Update panier SET count = ((Select count from panier where name =:name and ref = :ref)+1) where name =:name and ref =:ref";

    $prep = ($this->db)->prepare($req);


    $querry = $prep->execute(array(
    'name' => $name,
    'ref' => $ref
    ));
    var_dump($querry);
    echo 'DAO CLass 87 update ';


    /*
      $req = "Update panier SET count = ((Select count from panier where name ='$name' and ref =$ref)+1) where name ='$name' and ref =$ref";
    $querry = ($this->db)->query($req);
    $res = $querry->execute();
    */
    //echo (" DAO Class l 157 : $req");
  }
}

function getProduisPanier(string $name):array{

  $req ="SELECT p.*,q.count from products as p , panier as q WHERE q.name ='$name' and q.ref = p.ref";
  $querry = ($this->db)->query($req);
  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'ProductsPanier');
  return $tab;

  /*
  Ne marche pas et ne renvoies pas de valeur
  $req ="SELECT p.*,q.count from products as p , panier as q WHERE q.name =':name' and q.ref = p.ref";
  //$querry = ($this->db)->query($req);
  $querry =($this->db)->prepare($req);

  $querry->execute(array(
  'name' => $name,
  ));

  $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'ProductsPanier');

  var_dump($tab);

  */
}

function getUser(string $name, string $password){
	$req="SELECT * from user where name='$name' and password='$password'";
	$query = ($this->db)->query($req);
	$tab = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'User');
  if (isset($tab[0]))
      return $tab[0];
  return NULL;
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
