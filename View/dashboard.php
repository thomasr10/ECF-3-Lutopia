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
</form>

<?php if(isset($_POST['searchAdminUser'])){ 
        if(!isset($search)){
            echo 'Aucune carte séléctionner';
        } else {
            ?> <h2>Emprunt en cours</h2><hr><?php
            foreach($search as $key=>$value): ?>
                <article>
                    <p>Livre : <?= $search[$key]->getTitle(); ?> </p>
                    <p>Emprunt de : <?= $search[$key]->getName(); ?> </p>
                    <p>A rendre avant le : <?= $search[$key]->getEnd_date()->format('d-m-Y'); ?> </p>
                    <input type="date" placeholder="<?= $search[$key]->getEnd_date()->format('d-m-Y'); ?>">
                    <hr>
                    
                </article> 
            <?php endforeach;
        }
        
    }?>



<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

