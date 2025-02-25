<?php

$title = "Confirmation | Lutopia";
$description = "Page de confirmation de l'inscription à Lutopia";
ob_start();

?>

<h2>Test</h2>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base-html.php');
?>