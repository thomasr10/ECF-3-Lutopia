<?php

$title = "Dashboard | Lutopia";
$description = "Page dashboard de Lutopia";
$pointSlash = "";
ob_start();
?>


<h2>Bienvenue dans le dashboard !</h2>
<li><a href="<?=$router->generate('logout') ?>">Se déconnecter</a></li>
<form method="GET" action="/dashboard">
    <input type="text" name="searchAdminUser" id="searchAdminUser" value="">
    <input type="submit" value="🔍">
</form>

<?php if(isset($_GET['searchAdminUser']) && !empty($_GET['searchAdminUser'])){ 
        if(!isset($search)){
            echo 'Aucune carte séléctionner';
        } else {
            ?> 
            <hr>
            <h2>Réservation en cours</h2>
            <hr>
           <?php 
           foreach($reservation as $key=>$value):
           ?> 
           <form action="">
            <p><?= $reservation[$key]->getTitle(); ?></p> <input type="submit" value="Annuler">
           </form>
           <?php endforeach;
           echo 3 - count($reservation). ' reservations restantes'; ?>
           <hr>
            <h2>Emprunt en cours</h2><hr><?php
            foreach($search as $key=>$value): ?>
                <?=$search[$key]->getLast_Name()?>
                <article>
                    <p>Livre : <?= $search[$key]->getTitle(); ?> </p>
                    <p>Emprunt de : <?= $search[$key]->getName(); ?> </p>
                    
                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>">
                        <p>A rendre avant le : <?= $search[$key]->getEnd_date()->format('d-m-Y'); ?> </p>
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="date" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input type="submit" name="prolong" value="Prolonger">
                    </form>
                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>">
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="hidden" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input type="submit" name="suppr" value="Rendre">
                    </form>
                    <hr>
                    
                </article> 
            <?php endforeach;
        } 
        
    } else {
        echo 'Aucune carte séléctionner';
    }
    
    ?>



<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

