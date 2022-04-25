<?php
ob_start();
?>
<div class="row accueil">
    <section class="banniere col-12">
        <figure>
            <img src="<?= URL ?>public/images/baniere.avif" alt="e-cigarette">
        </figure>
    </section>

    <section class="produit">
        <div class="col-6 image-produit">
            <figure class="figure-image">
                <img id="image-produit" src="<?= URL ?>public/images/Rainbow_Candy.jpg" alt="e-cigarette parfum rainbow candy">
            </figure>
        </div>
        <div class="col-6 descriptif-produit">
            <div>

                <h2><?= htmlspecialchars($caracteristique->nom_produit_caracteristique) ?></h2>
                <div id="prix-produit"><?= htmlspecialchars($produits[0]->prix_produit) ?> €</div>
                <p><?= htmlspecialchars($caracteristique->description_caracteristique) ?></p>
                <h3>Spécification :</h3>
                <ul>
                    <li>Taille : <?= htmlspecialchars($caracteristique->taille_caracteristique) ?></li>
                    <li>Capacité batterie : <?= htmlspecialchars($caracteristique->capacite_batterie_caracteristique) ?></li>
                    <li>Puissance : <?= htmlspecialchars($caracteristique->puissance_caracteristique) ?></li>
                    <li>Tension de sortie : <?= htmlspecialchars($caracteristique->tension_sortie_caracteristique) ?></li>
                    <li>Capacité de E-liquide : <?= htmlspecialchars($caracteristique->capacite_liquide_caracteristique) ?></li>
                    <li>Résistance de la bobine : <?= htmlspecialchars($caracteristique->resistance_caracteristique) ?></li>
                    <li>Matériau : <?= htmlspecialchars($caracteristique->materiau_caracteristique) ?></li>
                </ul>
            </div>
            <div>

                <select name="parfum" id="selectParfum">
                    <?php
                    foreach ($produits as $key => $produit) : ?>
                        <option value="<?= htmlspecialchars($produit->id_produit) ?>"><?= htmlspecialchars($produit->parfum_produit) ?></option>

                    <?php endforeach; ?>
                </select>
                <div class="gestion-ajout-produit">
                    <span>Quantité :</span>
                    <div>
                        <div class="button-plus-moins">
                            <button>
                                -
                            </button>
                            <div>
                                <span>
                                    1
                                </span>
                            </div>
                            <button>
                                +
                            </button>
                        </div>
                        <div>
                            <div class="ajout-panier">
                                <div class='icone-bouton'>
                                    <img src="<?= URL ?>public/images/panier.png" alt="image_cigarette_electronique">
                                </div>
                                <span>
                                    Ajouter au panier
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="eclairage col-12">
        <h2 class="legende">Différents choix d'éclairage</h2>
        <figure>
            <img src="<?= URL ?>public/images/Choix_eclairage.avif" alt="Choix éclairage">
        </figure>
    </section>

    <section class="plug-and-play col-12">
        <h2 class="legende h2-haut-plug-and-play">Brevet pull & play</h2>
        <figure>
            <img src="<?= URL ?>public/images/Pull_and_play.avif" alt="Pull and play">
        </figure>
        <h2 class="legende h2-bas-plug-and-play">Attendre 2 minutes</h2>
    </section>

    <section class="batterie col-12">
        <h2 class="legende">Batterie intégrée de 1300 mAh</h2>
        <figure>
            <img src="<?= URL ?>public/images/Batterie_integree.avif" alt="Batterie integrée">
        </figure>
    </section>

    <section class="verifier-niveau-liquide col-12">
        <h2 class="legende">Vérifier le niveau du E-liquide par transparence des dosettes</h2>
        <figure>
            <img src="<?= URL ?>public/images/Verifier_niveau_liquide.avif" alt="Vérifier niveau e-liquide">
        </figure>
    </section>

    <section class="e-liquide-pre-rempli col-12">
        <h2 class="legende">6ml pré-rempli de E-liquid, + de 2500 bouffées</h2>
        <figure>
            <img src="<?= URL ?>public/images/E_liquide_pre_rempli.avif" alt="E-liquide pré-rempli">
        </figure>
    </section>

    <section class="caracteristique col-12">
        <h2>PARAMETRES :</h2>
        <!-- <ul>
            <li>Taille : Ø22.5mm * 115.5mm</li>
            <li>Tension de sortie : 3.5V</li>
            <li>Capacité batterie : 1300mAh</li>
            <li>Résistance de la bobine : 1.0Ω</li>
            <li>Puissance : 12.5W</li>
            <li>Capacité de E-liquide : 6ml</li>
            <li>Matériau : acier inoxydable et PCTG</li>
        </ul> -->
        <ul>
            <li>Taille : <?= htmlspecialchars($caracteristique->taille_caracteristique) ?></li>
            <li>Capacité batterie : <?= htmlspecialchars($caracteristique->capacite_batterie_caracteristique) ?></li>
            <li>Puissance : <?= htmlspecialchars($caracteristique->puissance_caracteristique) ?></li>
            <li>Tension de sortie : <?= htmlspecialchars($caracteristique->tension_sortie_caracteristique) ?></li>
            <li>Capacité de E-liquide : <?= htmlspecialchars($caracteristique->capacite_liquide_caracteristique) ?></li>
            <li>Résistance de la bobine : <?= htmlspecialchars($caracteristique->resistance_caracteristique) ?></li>
            <li>Matériau : <?= htmlspecialchars($caracteristique->materiau_caracteristique) ?></li>
        </ul>
    </section>
</div>



<?php
$titre = "Accueil";
$content = ob_get_clean();
require_once "template.php";
