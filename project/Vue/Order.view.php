<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Commander</title>
  </head>
  <body>
<h1>Facture</h1>
  <?php foreach ($tab as $a): ?>
<article class="zone">
  <h2>Nom : <?php $a->name ?> </h2>
  <br>

</article>

    <?php endforeach?>

  </body>
</html>
