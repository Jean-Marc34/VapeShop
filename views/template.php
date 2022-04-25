<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  <meta name="description" content="Le meilleur site de cigarette electronique"/>
  <link rel="canonical" href="<?= URL ?>"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?= URL ?>public/css/css.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= URL ?>public/images/E-cig-favicon.ico" />
  <title><?= $titre ?></title>
</head>

<body>

  <header class="my-menu" id="menu">
    <figure>
      <h1><img id="logo-vape-shop" src="<?= URL ?>public/images/vape_shop_logo.png" alt="Vape shop logo"></h1>
    </figure>
    <nav>
      <ul>
        <li>
          <a class="accueil" href="<?= URL ?>accueil"><span>Accueil</span></a>
        </li>
        <li>
          <a class="a-propos" href="<?= URL ?>apropos"><span>A propos</span></a>
        </li>
        <li>
          <a class="contact" href="<?= URL ?>contact"><span>Contact</span></a>
        </li>
        <li>
          <a class="my-icone" href="<?= URL ?>compte">
            <img src="<?= URL ?>public/images/utilisateur.png" alt="icone_utilisateur">
          </a>
        </li>
        <li>
          <a class="my-icone icone-panier"><img src="<?= URL ?>public/images/panier.png" alt="icone_panier"></a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="panier off">
    <?php
    echo 'IdPanier : ';
    ?>
  </div>
  <?php
  if ($admin) {
    echo '
    <nav class="menu-sup">
      <h2>Menu admin</h2>
      <ul>
        <li>
          <a href="' . URL . 'produit/ajouter">Ajouter un produit</a>
        </li>
        <li>
          <a href="' . URL . 'produit/lister">Gérer les produits</a>
        </li>
      </ul>
    </nav>';
  }
  ?>

  <?php
  GlobalController::afficheSucces();
  GlobalController::afficheEchec();
  ?>
  <div class="container">
    <?= $content ?>
  </div>

  <div class="container footer-container">
    <footer class="row">
      <div class="col-12 newsletter">
        <h2 class="footer-4h2">S'inscrire à la newsletter : </h2>
        <div class="my-newsletter">
          <input type="text" placeholder="Entrez votre email">
          <button>Souscrire</button>
        </div>
      </div>
      <div class="colonne-footer">
        <div>
          <h2 class="footer-1h2">Nous contacter</h2>
          <ul>
            <li class="footer-item-1-1">+33 601 23 45 67</li>
            <li class="footer-item-1-2">vape-shop@gmail.com</li>
          </ul>
        </div>
        <div>
          <h2 class="footer-2h2">Service client</h2>
          <ul>
            <li class="footer-item-2-1">Nous contacter</li>
            <li class="footer-item-2-2">Commande et paiement</li>
            <li class="footer-item-2-3">Expédition</li>
            <li class="footer-item-2-4">Retour</li>
            <li class="footer-item-2-5">FAQ</li>
          </ul>
        </div>
        <div>
          <h2 class="footer-3h2">Information</h2>
          <ul>
            <li class="footer-item-3-1">Politique et confidentialité</li>
            <li class="footer-item-3-2">Termes & conditions</li>
          </ul>
        </div>
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  <script src="<?= URL ?>public/js/mon-js.js"></script>
</body>

</html>