<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Mes articles</title>
  <link rel="stylesheet" href="../Vue/css/Article.css">
</head>
<body>
  <header>
    <?php include('../Vue/header.php')?>
  </header>

<?php if(isset($err)): //Afficage des erreur vus precedament?>
<p class="error"><?php echo "$err" ?></p>
<?php endif; ?>

  <fieldset>
    <div class="tri">
      <form class="bouton" action="Products.ctrl.php" method="get">
        <select class="choix_categorie" name="choix_categorie">
          <option value="Toutes catégories">Toutes catégories </option>
          <?php foreach ($categories as $b){ //Afichage des categorie
            if ($b->name != ""){
              echo "<option value=\"$b->name\">$b->name</option>";
            }
          }?>
        </select>
        <select class="choix_prix" name="choix_prix">
          <option value="tous">Tous les prix</option>
          <option value="croissant">Prix croissants</option>
          <option value="décroissant">Prix décroissants</option>
        </select>
        <input type="submit" name="submit" value="Recherche">
      </form>
    </div>
  </fieldset>

  <h1>Voici les chats disponibles</h1>

  <div class="main">
    <?php foreach ($products as $a): //Afichge de toute les image ?>
      <article class="article">
        <div class="image">
          <img src="<?=$imagePath.$a->image?>" alt="<?=$a->description?>">
        </div>
        <section class="détails">
          <h2><?=$a->name?></h2>
          <p class="description"><?=$a->description ?></p><br>
          <p class="prix"><?=$a->price ?>€</p>
          <br>
          <form class="bouton" action="Products.ctrl.php" method="get">
            <input type="hidden" name="add" value=<?php echo ("\"$a->ref\"") ?> >
            <input type="hidden" name="page" value=<?php echo ("\"$page\"") ?>>
            <input class="panier" type="submit" name="sbumit" value="Ajouter au panier"  >
          </form>
        </section>
      </article>
    <?php endforeach?>
  </div>

  <br>
  <br>

  <div class="arrow">
    <a href=<?php echo ("\"Products.ctrl.php?page=$pagePrecedente&choix_categorie=".$category."&choix_prix=".$triprix."\"") ?> > <img src="../Modele/data/images/left.png" alt="LEFT"> </a>
    <p> <?php echo $page ?> </p>
    <a href=<?php echo ("\"Products.ctrl.php?page=$pageSuivante&choix_categorie=".$category."&choix_prix=".$triprix."\"") ?> > <img src="../Modele/data/images/right.png" alt="right"> </a>
  </div>


</body>
</html>
