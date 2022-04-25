<?php
ob_start();
?>

<?php
if ((!isset($_SESSION["admin"]))  && (!isset($_COOKIE['admin']))) {
    header("Location:" . URL . "accueil");
}
GlobalController::afficheSucces();
GlobalController::afficheEchec();
// var_dump($produits);
?>
<div class="liste-produits">
    <section class="container_form col-12">
        <h1 class="tac">Liste des produits</h1>
        <?php
        foreach ($produits as $key => $produit) : ?>
            <div class="produit-list" id="produit<?= $produit->id_produit ?>">
                <div class="produit-row">
                    <div class="image-produit-list">
                        <figure>
                            <img src="<?= URL ?>public/images/<?= htmlspecialchars($produit->nom_image_produit) ?>" alt="e-cigarette parfum <?= htmlspecialchars($produit->parfum_produit) ?>">
                        </figure>
                    </div>
                    <div class="info-produit-list">
                        <form class="form" action="<?= URL ?>api/modifierProduit/<?= $produit->id_produit ?>" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="parfum">Parfum : </label>
                                <input type="text" name="parfum" required value="<?= htmlspecialchars($produit->parfum_produit) ?>">
                            </div>
                            <div>
                                <label for=" prix">Prix : </label>
                                <input type="text" name="prix" required value="<?= htmlspecialchars($produit->prix_produit) ?>">
                            </div>
                            <div>
                                <label for=" quantite">Quantité :</label>
                                <input type="text" name="quantite" required value="<?= htmlspecialchars($produit->quantite_produit) ?>">
                            </div>
                            <div>
                                <label for=" image">Image produit : </label>
                                <input type="file" name="image" value="<?= $produit->nom_image_produit ?>">
                            </div>
                            <div class="button-row">
                                <div>
                                    <div>
                                        <button class="button-modifier-produit" type=" submit" value="<?= $produit->id_produit ?>">Modifier</button>
                                    </div>
                                    <div>
                                        <button class="button-supprimer-produit" type="submit" value="<?= $produit->id_produit ?>">Supprimer</button>
                                    </div>
                                </div>
                                <span></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<?php
$titre = "Liste des produits";
$content = ob_get_clean();
require_once "template.php";
?>