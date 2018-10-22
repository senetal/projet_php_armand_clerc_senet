<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Mes articles</title>
  <link rel="stylesheet" href="../Vue/css/Article.css">
</head>
<body>

  <h1>Voici les chat disponible</h1>

  <div class="main">
    <?php foreach ($products as $a): ?>

      <article class="article">
        <h2><?=$a->name?></h2>
        <img src="<?=$imagePath.$a->image?>"   alt="">
        <br>
        <p class="prix"><?=$a->price ?>€</p> <br>
        <p><?=$a->description ?></p>
      

        <form class="bouton" action="Products.ctrl.php" method="get">
          <input type="hidden" name="add" value=<?php echo ("\"$a->ref\"") ?> >
          <input type="hidden" name="page" value=<?php echo ("\"$page\"") ?>>
          <input type="submit" name="sbumit" value="Ajouter au pannier"  >
        </form>

      </article>
    <?php endforeach?>

  </div>

  <br>
  <br>

  <div class="arrow">

    <a href=<?php echo ("\"Products.ctrl.php?page=".($page-1))."\"" ?> > <img src="../Modele/data/images/left.png" alt="LEFT"> </a>
    <p> <?php echo $page ?> </p>
    <a href=<?php echo ("\"Products.ctrl.php?page=".($page+1))."\"" ?> > <img src="../Modele/data/images/right.png" alt="right"> </a>

  </div>
</body>
</html>
