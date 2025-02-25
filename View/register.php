<?php

$title = "Inscription | Lutopia";
$description = "Page d'inscription de Lutopia";
ob_start();

?>
<!-- MESSAGE D'ERREUR -->
<div>
    <p><?= $message ?></p>
</div>
<form action="/lutopia/register" method="POST">
    <div>
        <label for="name">Pseudo</label>
        <input type="text" placeholder="Votre pseudo" name="name" id="name" require>
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="text" placeholder="Votre adresse mail" name="email" id="email" require>
    </div>
    <div>
        <label for="password">Votre mot de passe</label>
        <input type="password" placeholder="Votre mot de passe" name="password" id="password"> 
    </div>
    <div>
        <label for="confpassword">Votre mot de passe</label>
        <input type="password" placeholder="Confirmez votre mot de passe" name="confpassword" id="confpassword"> 
    </div>
    <div>
        <input type="submit" value="S'inscrire">
    </div>
</form>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>