<?php
$title = "Modifier utilisateur | Lutopia";
$description = "Page de modification d'un utilisateur sur le dashboard admin de Lutopia";
$arrayJs = ['../assets/js/dashboard_update_user.js'];
ob_start();

?>

<div class="modal" id="delete-child-modal">
    <p>Êtes-vous sûr(e) de vouloir supprimer cet enfant ?</p>
    <button type="button" id="confirm-delete-child">Confirmer</button>
</div>
<div class="modal" id="delete-user-modal">
    <p>Êtes-vous sûr(e) de vouloir supprimer cet utilisateur ?</p>
    <button type="button" id="confirm-delete-user">Confirmer</button>
</div>


<h1 class = "update-user-title">Modifier un utilisateur</h1>
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

<div class="update-user-container">
<form action="/dashboard/update-user" method="POST">
    <div class="update-user-form1">
        <div class="update-user-entry">
            <label for="first-name">Prénom</label>
            <input type="text" name="first-name" id="first-name" value="<?=$user->getFirst_name() ?>" required>
        </div>
        <div class="update-user-entry">
            <label for="last-name">Nom de famille</label>
            <input type="text" name="last-name" id="last-name" value="<?=$user->getLast_name() ?>" required>
        </div>
        <div class="update-user-entry">
            <label for="email">Adresse mail</label>
            <input type="text" name="email" id="email" value="<?=$user->getEmail() ?>" required>
        </div>
        <div>
            <input type="hidden" name="id_user" value="<?= $user->getId_user()?>">
        </div>
        <div class="update-user-sub-entry">
            <button id="delete-user-btn" type="button" value="<?= $user->getId_user() ?>">Supprimer</button>
        </div>
    </div>
    <?php foreach($children as $child){ ?>
        <!-- div en dessous à flex pour aligner le prénom et la date comme sur figma -->
        <div class=" update-user-border">
            <div class="update-user-sub-entry">
                <!-- bouton en dessous : trouver l'image du figma. Gardez bien la value et la class si vous changez le bouton -->
                <button class="delete-child-btn" value="<?= $child->getId_child() ?>" type="button">Supprimer</button>
                <label for="child-name">Prénom</label>
                <input type="text" value="<?=$child->getName()?>" name="child-name[]" id="child-name">
                <input type="hidden" name="id_child[]" id="id_child" value="<?=$child->getId_child()?>">
            </div>
            <div class="update-user-sub-entry">
                <label for="child-birth">Date de naissance</label>
                <input type="date" name="child-birth[]" id="child-birth" value="<?=$child->getBirth_date()->format('Y-m-d')?>">
            </div>        
        </div>
    <?php } ?>
        <div id="add-child" class="update-user-sub-entry"></div>
        <div class = "update-user-addchild">
            <button id="add-child-btn" type="button">Ajouter un enfant</button>
        </div>  
    <div class = "update-user-modifications">
        <input type="submit" value="Valider les modifications" name="update-user">
        <input type="reset" value="Annuler les modifications">
    </div>
</form>
</div>
<?php
}
?>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>