<?php
$title = "Modifier utilisateur | Lutopia";
$description = "Page de modification d'un utilisateur sur le dashboard admin de Lutopia";
ob_start();

?>
<h1>Modifier un utilisateur</h1>
<div class = "dash-accueil-user">   
    <form class="dash-accueil-form" method="GET" action="/dashboard/update-user">
        <input type="text" name="search-user" id="searchAdminUser" value="" placeholder="Entrez ici le n° d'abonné">
        <button name="search" type="submit" >
            <img src="/uploads/autres/icon-loupe.svg" alt="">
        </button>
    </form>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>