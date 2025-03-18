<?php
$title = "Modifier utilisateur | Lutopia";
$description = "Page de modification d'un utilisateur sur le dashboard admin de Lutopia";
ob_start();

?>
<h1>Modifier un utilisateur</h1>
<div class = "dash-accueil-user">   
    <form class="dash-accueil-form" method="GET" action="/dashboard/update-user">
        <input type="text" name="user-card" id="searchAdminUser" value="" placeholder="Entrez ici le n° d'abonné">
        <button type="submit" >
            <img src="/uploads/autres/icon-loupe.svg" alt="">
        </button>
    </form>
</div>
<?php
if(!empty($user) && !empty($children)){
?>
<form action="/dashboard/update-user" method="POST">
    <div>
        <label for="first-name">Prénom</label>
        <input type="text" name="first-name" id="first-name" value="<?=$user->getFirst_name() ?>" required>
    </div>
    <div>
        <label for="last-name">Nom de famille</label>
        <input type="text" name="last-name" id="last-name" value="<?=$user->getLast_name() ?>" required>
    </div>
    <div>
        <label for="email">Adresse mail</label>
        <input type="text" name="email" id="email" value="<?=$user->getEmail() ?>" required>
    </div>
    <div>
        <input type="hidden" name="id_user" value="<?= $user->getId_user()?>">
    </div>
    <?php foreach($children as $child){ ?>
        <!-- div en dessous à flex pour aligner le prénom et la date comme sur figma -->
        <div>
            <div>
                <!-- bouton en dessous : trouver l'image du figma -->
                <button type="button">Supprimer</button>
                <label for="child-name">Prénom</label>
                <input type="text" value="<?=$child->getName()?>" name="child-name[]" id="child-name">
                <input type="hidden" name="id_child[]" id="id_child" value="<?=$child->getId_child()?>">
            </div>
            <div>
                <label for="child-birth">Date de naissance</label>
                <input type="date" name="child-birth[]" id="child-birth" value="<?=$child->getBirth_date()->format('Y-m-d')?>">
            </div>            
        </div>
    <?php } ?>
    <div>
        <input type="submit" value="Valider les modifications" name="update-user">
        <input type="reset" value="Annuler les modifications">
    </div>
</form>
<?php
}
?>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>