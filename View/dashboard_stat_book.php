<?php
$title = "Statistiques livre | Lutopia";
$description = "Page dde consultation des statistiques liées aux livres sur le dashboard admin de Lutopia";
ob_start();

?>




<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>