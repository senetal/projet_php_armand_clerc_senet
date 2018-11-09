
<?php

//Si une perssone est connecte pour le hedar , plus simple que de le mettre partout
require_once('../Modele/User.class.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['user'])){
      $user = $_SESSION['user'];
    }
}

if(isset($user)){
  $name = $user->name;
}

 ?>
<link rel="stylesheet" href="../Vue/css/Header.css">
<div class="header">
  <nav>
    <div class="refBareMenu">
      <ul>
        <li><div class="refAccueil"><a href="../Vue/main.view.php">Acceuil</a></div></li>
        <li><a href="../Controleur/Proposition.ctrl.php">Dépot d'annonce</a></li>
        <li><a href="../Controleur/Products.ctrl.php">Offres</a></li>

<!-- Si une perssone est onnete ou nom  -->
        <?php if (isset($name)): //Si connete elle peux acede as ses offre ou son compte ?>
          <li><a href="../Controleur/myoffers.ctrl.php">Mes offre</a></li>


        <li style="float:right"><div class="refConnexion"><a href="../Vue/account.view.php"><?php echo $name; ?></a></div></li>
      <?php else: //Si pas connetie on lui propose de ce connte  ?>
        <li style="float:right"><div class="refConnexion"><a href="../Vue/login.view.php">Connexion</a></div></li>
        <?php endif ?>

          <li><a href="../Controleur/Order.ctrl.php">Panier</a></li>
      </ul>
    </div>
  </nav>
</div>
