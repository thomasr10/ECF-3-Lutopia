<?php
$title = "Connexion Admin | Lutopia";
$description = "Page de connexion admin à Lutopia";
$pointSlash = "";
ob_start();
?>
<div>
   <?= (isset($message)) ? $message : '' ?> 
</div>
<div class="center">
<form method="POST" action="/login-admin">
    <div id="loginAdmin">
    <div>
        <label for="name">Name :</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
    </div>
    <input type="submit" value="Connexion">
    </div>
</form>
</div>
<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

