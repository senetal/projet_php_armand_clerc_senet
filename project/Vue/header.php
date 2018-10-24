
<link rel="stylesheet" href="../Vue/css/Header.css">
<div class="header">
  <nav>
    <div class="refBareMenu">
      <ul>
        <li><div class="refAccueil"><a href="../Vue/main.view.php">Acceuil</a></div></li>
        <li><a href="../Controleur/Annonces.ctrl.php">Dépot d'annonce</a></li>
        <li><a href="../Controleur/Products.ctrl.php">Offres</a></li>
        <li><a href="../Controleur/Demandes.ctrl.php">Demandes</a></li>
        <li><a href="../Controleur/Panier.ctrl.php">Panier</a></li>
        <?php $name = 'toto'; ?>
        <?php if (isset($name)): ?>
        <li style="float:right"><div class="refConnexion"><a href="../Controleur/account.ctrl.php"><?php echo $name; ?></a></div></li>
        <?php else: ?>
        <li style="float:right"><div class="refConnexion"><a href="../Controleur/account.ctrl.php">Connexion</a></div></li>
        <?php endif ?>
      </ul>
    </div>
  </nav>
</div>
