<?php
ob_start();
GlobalController::afficheEchec();
?>

<H1>Cette page n'existe pas</H1>

<?php
$titre = "Erreur 404";
$content = ob_get_clean();
require_once "template.php";
?>