<?php
$title = "Création mot de passe | Lutopia";
$description = "Page de création du mot de passe, après une inscription par l'admin.";
ob_start();
?>
<?php
// Get id from url
$url = $_SERVER['REQUEST_URI'];
$s = explode('/', $url);
$id = end($s);
?>
<?= (isset($message)) ? $message : '' ?>
<div>
    <form action="<?='/create-password' . '/' . $id ?>" method="POST">
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe (min 8 caractère + un spécial)" required>            
        </div>
        <div>
            <label for="confpassword">Mot de passe</label>
            <input type="password" name="confpassword" id="confpassword" placeholder="Mot de passe (min 8 caractère + un spécial)" required>            
        </div>
        <div>
            <input type="submit" value="Valider">
        </div>
    </form>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');