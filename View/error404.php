<?php

$title = '404 | Lutopia';
$description = 'Trying to access page that doesnt exist';
$arrayJs = ["./assets/js/search-bar.js"];
$pointSlash = "";

ob_start();

?>
<div style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 50px;">
    <h1 style="font-size: 80px; color: #ff4c4c; margin-bottom: 20px;">Oups !</h1>
    <h2 style="font-size: 30px; color: #333; margin-bottom: 15px;">La page que vous recherchez est introuvable.</h2>
    <p style="font-size: 18px; color: #666; margin-bottom: 30px;">Il semble que cette page n'existe plus ou que vous ayez suivi un lien incorrect.</p>
    
    <img src="/uploads/autres/error 404.jpg" alt="Erreur 404" style="max-width: 100%; width: 400px; margin: 30px 0; display: block;">
    
    <a href="/" style="display: inline-block; padding: 12px 25px; font-size: 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 40px;">Retour à l'accueil</a>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>