<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Propositon</title>
  <link rel="stylesheet" href="../Vue/css/formulaire.css">
</head>
<body>
  <header>
    <?php include('header.php')?>
  </header>

  <div class="main">
    <h1>Propose vos propre chat </h1>
    <article class="">
      <form class="" action="../Controleur/Proposition.ctrl.php" method="post" enctype="multipart/form-data" >

        <article class="champ">
          <div class="d25">


            <label for="title">Titre* :</label>

          </div>
          <div class="d75">

            <input type="text" id="prix" name="title" value="" required>

          </div>
        </article>

        <article class="champ">
          <div class="d25">


            <label for="desc">Description* :</label>

          </div>
          <div class="d75">

            <textarea name="desc" rows="8" cols="80" required></textarea>

          </div>
        </article>

        <article class="champ">
          <div class="d25">


            <label for="prix">Prix* :</label>

          </div>
          <div class="d75">

            <input type="number" id="prix" name="prix" value=""required >
          </div>
        </article>


        <br>

        <article class="champ">

          <div class="d25">


            <label for="cat">Categories* :</label>

          </div>
          <div class="d75">

            <select class="choix_categorie" id="cat" name="choix_categorie" required>
              <option value="Toutes catégories" disabled selected>Toutes catégories</option>
              <?php foreach ($categories as $b){
                if ($b->name != ""){
                  echo "<option value=\"$b->name\">$b->name</option>";
                }
              }?>
            </select>

          </div>

        </article>

        <article class="champ">
          <div class="d25">


            <label for="file">Image* :</label>

          </div>
          <div class="d75">

            <input type="file" id="file" name="fileToUpload" id="fileToUpload" required>
          </div>
        </article>





        <input type="submit" name="valide" value="Poster" >
      </form>
    </article>

  </div>

  <footer>

    <?php include('footer.php')?>
  </footer>
</body>
</html>
