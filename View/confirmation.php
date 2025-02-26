<?php

$title = "Confirmation | Lutopia";
$description = "Page d'envoie de mail pour la confirmation d'inscription à Lutopia";
ob_start();

?>
<!-- affichage temporaire -->
<h1>Vérifiez votre boîte mail</h1>
<a href="<?= $router->generate('new-mail', ['id' => $id]) ?>">Renvoyer un mail</a>
<!-- MESSAGE D'ERREUR -->
<?= (isset($message)) ? $message : '' ?>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>
