<?php
ob_start();
GlobalController::afficheEchec();
?>

<form method="POST" action="validate" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre : </label>
    <input type="text" class="form-control" name="titre" required>
  </div>
  <div class="mb-3">
    <label for="nombrePage" class="form-label">Nombre de page : </label>
    <input type="text" class="form-control" name="nbPages" required>
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image : </label>
    <input type="file" name="picture" required>
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<?php
$titre = "A propos";
$content = ob_get_clean();
require_once "template.php";
