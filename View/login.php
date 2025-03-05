<?php

$title = "Connexion | Lutopia";
$description = "Page de connexion à Lutopia";
$pointSlash = "";
ob_start();
?>
<div>
   <?= (isset($message)) ? $message : '' ?> 
</div>
<form action="/login" method="POST">
    <div>
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email" placeholder="Votre adresse mail" <?php if(isset($_COOKIE['remember_mail'])){echo 'value="' . $_COOKIE['remember_mail'] . '"';} ?> required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
    </div>
    <div>
        <label for="Check1">Rester connecté</label>
        <input type="checkbox" name="Check1" id="Check1" <?php if(isset($_COOKIE['remember'])){echo 'checked';} ?> >
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>

<?php

$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');