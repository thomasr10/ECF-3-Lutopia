<?php
$title = "Paramètre du profil | Lutopia";
$description = "paramètre de votre profil Lutopia";
$arrayJs = [""];
$pointSlash = "";
ob_start();
?>

<?php if(isset($message)){ echo $message; }; ?>

<h2>Paramètre de votre compte :</h2>
<form action="/profil/parameter" method="POST">
    <label for="name">Prénom : </label>
    <input type="text" name="first-name" value="<?= $user->getFirst_Name() ?>" id="name">
    <label for="lastname">Nom : </label>
    <input type="text" name="last-name" value="<?= $user->getLast_Name() ?>" id="lastname">
    <label for="email">Email : </label>
    <input type="email" name="email" value="<?= $user->getEmail() ?>" id="email">
    <input type="submit" name="changeinfo" value="Changer">
</form>

<form action="/profil/parameter" method="POST">
    <label for="latepass">Ancien mot de passe :</label>
    <input type="password" name="latepass" id="latepass">
    <label for="newpass">Nouveau mot de passe :</label>
    <input type="password" name="newpass" id="newpass">
    <label for="newpass2">Re-nouveau mot de passe :</label>
    <input type="password" name="newpass2" id="newpass2">
    <input type="submit" name="changepass" value="Changer">
</form>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>