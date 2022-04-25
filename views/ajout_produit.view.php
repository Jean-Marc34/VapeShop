<?php
ob_start();
?>

<?php
if ((!isset($_SESSION["admin"]))  && (!isset($_COOKIE['admin']))) {
    header("Location:" . URL . "accueil");
}
GlobalController::afficheSucces();
GlobalController::afficheEchec();
?>

<div class="ajout-produit">
    <section class="container_form">
        <h1 class="tac">Ajouter un produit</h1>
        <form class="form" action="<?= URL ?>produit/ajouterOk" method="POST" enctype="multipart/form-data">
            <div>
                <label for="parfum">Parfum : </label>
                <input type="text" name="parfum" id="parfum" required>
            </div>
            <div>
                <label for="prix">Prix : </label>
                <input type="text" name="prix" id="prix" required>
            </div>
            <div>
                <label for="quantite">Quantité :</label>
                <input type="text" name="quantite" id="quantite" required>
            </div>
            <div>
                <label for="image">Image produit : </label>
                <input type="file" name="image" id="image" required>
            </div>
            <div class="row-button">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </section>
</div>

<?php
$titre = "Ajouter un produit";
$content = ob_get_clean();
require_once "template.php";
?>