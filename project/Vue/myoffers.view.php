<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mes offres</title>
      <link rel="stylesheet" href="../Vue/css/Order.css">
  </head>
  <body>
    <?php include('../Vue/header.php')?>

    <?php include('../Vue/accountmenu.php') ?>

<h1>Mes offres</h1>

<div class="achat">


  <?php foreach ($tab as $a): ?>
<article class="zone">
  <h2>Nom : <?=$a->name; ?> </h2>
  <p> ref : <?=$a->ref?></p>

<img src=<?php echo "\"../Modele/data/images/$a->image\""; ?> alt="Une image">
  <br>

<p> Prix Unitaire : <?= $a->price;?></p>

  <br>

</article>
<br>
<br>
    <?php endforeach?>
<br>
<br>
</div>
  </body>
</html>
