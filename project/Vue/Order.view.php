
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

  <?php if(isset($command)): ?>

    <?php if($command): ?>
      <h2 class="sucesse">Commande passee avec succes</h2>
    <?php else :?>
      <h2 class="fail">Erreur lors de la commande </h2>
    <?php endif ?>

  <?php endif?>

  <h1>Facture</h1>

  <div class="achat">

    <?php if(isset($tab) ): ?>
      <?php foreach ($tab as $a): ?>
        <article class="zone">
          <h2>Nom : <?= $a->name; ?> </h2>
          <p> ref : <?=$a->ref?></p>

          <img src=<?php echo "\"../Modele/data/images/$a->image\""; ?> alt="Une image">
          <br>

          <p> Prix unitaire : <?= $a->price;   ?>     Nombre de produits:<?= $a->count; ?> </p>
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

      <?php if(sizeof($tab)>0) ?>
      <article class="Conclution">
        <p>Total = <?=$totalPrice ?> </p>
        <form class="" action="../Controleur/Order.ctrl.php" method="get">
          <input type="submit" name="valide" value="Commander">
        </form>

      <?php else: ?>

        <?php if(isset($name)): ?>
          <p class="noArticle">Vous n'avez pas d'article dans votre panier </p>

        <?php else: ?>
          <p class="noArticle">Vous devez etre connecte pour consuter votre panier </p>
        <?php endif; ?>
      <?php endif; ?>
    </article>
  </div>
</body>
</html>
