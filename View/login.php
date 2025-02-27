<?php

$title = "Connexion | Lutopia";
$description = "Page de connexion à Lutopia";
ob_start();
?>
<div>
   <?= (isset($message)) ? $message : '' ?> 
</div>
<form action="/login" method="POST">
    <div>
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email" placeholder="Votre adresse mail" required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>

<?php

$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');