<?php

$title = "Dashboard | Lutopia";
$description = "Page dashboard de Lutopia";
$pointSlash = "";
ob_start();
?>


<h2>Bienvenue dans le dashboard !</h2>
<li><a href="<?=$router->generate('logout') ?>">Se déconnecter</a></li>
<form method="POST" action="/dashboard">
    <input type="text" name="searchAdminUser" id="searchAdminUser" placeholder="Search user card">
    <input type="submit" value="🔍">
    <input type="reset" value="Reset">
</form>



<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

