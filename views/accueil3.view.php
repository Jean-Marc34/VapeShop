<?php 
    ob_start();
?>

<div class="row">
    <section class="banniere col-12">
        <figure>
            <img src="./public/images/baniere.png" alt="banière e-cigarette">
        </figure>
    </section>

    <section class="produit col-12">
        <!-- <figure>
            <img src="./public/images/baniere.png" alt="banière e-cigarette">
        </figure> -->
        <p>Partie produit</p>
    </section>

    <section class="eclairage col-12">
        <h2 class="legende">Différents choix d'éclairage</h2>
        <figure>
            <img src="./public/images/Choix_eclairage.png" alt="Choix éclairage">
        </figure>
    </section>

    <section class="plug-and-play col-12">
        <p class="legende p-haut-plug-and-play">Brevet pull & play</p>
        <figure>
            <img src="./public/images/Pull_and_play.png" alt="Pull and play">
        </figure>  
    </section>
    <div class="col-7"></div><p class="legende p-bas-plug-and-play col-5">Attendre 2 minutes</p>

    <div class="col-2"></div><p class="legende p-batterie col-10">Batterie intégrée de 1300 mAh</p>
    <section class="batterie col-12">
        <figure>
            <img src="./public/images/Batterie_integree.png" alt="Batterie integrée">
        </figure>
    </section>

    <section class="verifier-niveau-liquide col-12">
        <p class="legende">Vérifier le niveau du E-liquide par transparence des dosettes</p>
        <figure>
            <img src="./public/images/Verifier_niveau_liquide.png" alt="Vérifier niveau e-liquide">
        </figure>
    </section>

    <section class="e-liquide-pre-rempli col-12">
        <p class="legende">6ml pré-rempli de E-liquid, + de 2500 bouffées</p>
        <figure>
            <img src="./public/images/E_liquide_pre_rempli.png" alt="E-liquide pré-rempli">
        </figure>
    </section>

    <section class="caracteristique col-12">
        <h2 class="legende">PARAMETRES :</h2>
        <div class="row">
            <ul class="col-7">
                <li>Taille : Ø22.5mm * 115.5mm</li>
                <li>Capacité batterie : 1300mAh</li>
                <li>Puissance : 12.5W</li>
                <li>Matériau : acier inoxydable et PCTG</li>
            </ul>
            <ul class="col-5">
                <li>Tension de sortie : 3.5V</li>
                <li>Résistance de la bobine : 1.0Ω</li>
                <li>Capacité de E-liquide : 6ml</li>
            </ul>
        </div>
    </section>
</div>



<?php
$titre = "Accueil";
$content = ob_get_clean();
require_once "template.php";
