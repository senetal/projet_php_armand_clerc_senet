
<?php
include '../../Modele/Products.class.php';
$source = 'sqlite:data.db';
$db = new PDO($source);
$sql = file_get_contents('insert.sql');
//$qr = $db->exec($sql);

/*
$r=  "insert into products values
  (0,'He He',21,'0.png','Chat d un ancien president ','Mignon',1),
    (4,'Chat Masque',56,'4.jpg','Vous ne savez pas ce quil prepare','Mignon',0),
      (5,'Chat percher',74,'5.jpg','Big broser waching you','MANGE TON AME',1)";
*/

$r = "UPDATE products SET image = '5.jpg' WHERE ref = 5";

$res = $db->exec($r);
var_dump ($res);


      $req = "SELECT * FROM products ";

      $querry = $db->query($req);
      $tab = $querry->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Products');




var_dump($tab);
echo "\n end";
 ?>
