<?php
ob_start();
GlobalController::afficheEchec();
echo 'Page panier';
?>


<!-- <form method="POST" action="<?= URL ?>livre/modifier_validate" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre : </label>
    <input type="text" class="form-control" name="titre" value="<?= $controller->getTitre(); ?>" required>
  </div>
  <div class="mb-3">
    <label for="nombrePage" class="form-label">Nombre de page : </label>
    <input type="text" class="form-control" name="nbPages" value="<?= $controller->getNombrePage(); ?>" required>
  </div>
  <div class="mb-3">
    <img class="card" style="width : 25rem" src="<?= URL . 'public/images/' . $controller->getImage(); ?>" alt="<?= $controller->getTitre(); ?>">
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image : </label>
    <input type="file"name="picture">
  </div>
  <input name="image" type="hidden" value="<?= $controller->getImage(); ?>">
  <input name="idLivre" type="hidden" value="<?= $controller->getId(); ?>">
  <button type="submit" class="btn btn-primary">Modifier</button>
</form> -->



<?php
$titre = "Modifier livre";
$content = ob_get_clean();
require_once "template.php";
?>