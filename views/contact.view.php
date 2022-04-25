<?php
ob_start();
?>


<?php
echo 'Contact'
?>


<?php
$titre = "Contact";
$content = ob_get_clean();
require_once "template.php";
?>