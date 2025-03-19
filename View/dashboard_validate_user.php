<?php

$title = "Confirmation inscription depuis le dashboard | Lutopia";
$description = "Page d'envoie de mail pour la confirmation d'inscription à Lutopia";
ob_start();

?>
<!-- affichage temporaire -->
<h1>Inscription prise en compte !</h1>
<p>Un courrier éléctronique a été envoyé à l'utilisateur</p>
<!-- MESSAGE D'ERREUR -->
<?= (isset($message)) ? $message : '' ?>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');
?>