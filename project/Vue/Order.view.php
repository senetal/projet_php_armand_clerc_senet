
<?php
$totalPrice = 0;
$sumCount = 0;
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Commander</title>
      <link rel="stylesheet" href="../Vue/css/Order.css">
  </head>
  <body>
    <?php include('../Vue/header.php')?>
<h1>Facture</h1>

<div class="achat">


  <?php foreach ($tab as $a): ?>
<article class="zone">
  <h2>Nom : <?= $a->name; ?> </h2>
  <p> ref : <?=$a->ref?></p>

<img src=<?php echo "\"../Modele/data/images/$a->image\""; ?> alt="Une image">
  <br>

<p> Prix Unitaire : <?= $a->price;   ?>     Nombre de produis:<?= $a->count; ?> </p>
  <?php $totalPrice +=$a->price*$a->count;
        $sumCount += $a->count;
  ?>

  <br>

  <p>Sous Total = <?= $a->price*$a->count ?> </p>
</article>
<br>
<br>
    <?php endforeach?>
<br>
<br>
    <article class="Conclution">
      <p>Total = <?=$totalPrice ?> </p>
      <form class="" action="../Controleur/Order.ctrl.php" method="get">
<input type="submit" name="valide" value="Commender">
      </form>
    </article>
</div>
  </body>
</html>
