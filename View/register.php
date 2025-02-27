<?php

$title = "Inscription | Lutopia";
$description = "Page d'inscription de Lutopia";
ob_start();

?>
<!-- MESSAGE D'ERREUR -->
<div>
    <p><?= (isset($message)) ? $message : '' ?></p>
</div>
<form action="/register" method="POST">
    <div>
        <label for="first-name">Prénom</label>
        <input type="text" placeholder="Votre prénom" name="first-name" id="first-name" required>
    </div>
    <div>
        <label for="name">Nom de famille</label>
        <input type="text" placeholder="Votre nom de famille" name="name" id="name" required>
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="email" placeholder="Votre adresse mail" name="email" id="email" required>
    </div>
    <div id="child-section">
        <div>
            <label for="child-1">Enfant 1</label>
            <input type="text" name="child-name[]" id="child-1" placeholder="Prénom de l'enfant" minlength="2" required>
            <label for="birth-1">Date de naissance</label>
            <input type="date" id="birth-1" name="child-birth[]" placeholder="Date de naissance" required>
            <input type="button" id="add-child" value="Ajouter un enfant">           
        </div>
    </div>
    <div>
        <label for="password">Votre mot de passe</label>
        <input type="password" placeholder="Votre mot de passe" name="password" id="password" required> 
    </div>
    <div>
        <label for="confpassword">Confirmez votre mot de passe</label>
        <input type="password" placeholder="Confirmez votre mot de passe" name="confpassword" id="confpassword" required> 
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