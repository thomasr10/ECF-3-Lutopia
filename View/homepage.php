<?php 
$title = 'Accueil | Lutopia';
ob_start();
?>

<h1>Bienvenue sur la page d'accueil</h1>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>