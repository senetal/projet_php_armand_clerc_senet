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
<img src="<?=$imagePath.$a->image?>"  width="40%" alt="">
<p><?=$a->price ?>€</p> <br>
<p><?=$a->description ?></p>
<p> ref = <?=$a->ref ?></p>
</article>
  <?php endforeach?>

</div>

<a href="#">  </a>

  </body>
</html>
