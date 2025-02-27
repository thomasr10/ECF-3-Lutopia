<?php
//Page qui s'affiche si le token est invalide ou expiré
$title = "Confirmation | Lutopia";
$description = "Page de confirmation de l'inscription à Lutopia";
ob_start();

?>

<h2>Token invalide ou expiré</h2>
<a href="<?= $router->generate('new-mail', ['id' => $id]) ?>">Renvoyer un mail</a>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>