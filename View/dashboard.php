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
                <?=$search[$key]->getLast_Name()?>
                <article>
                    <p>Livre : <?= $search[$key]->getTitle(); ?> </p>
                    <p>Emprunt de : <?= $search[$key]->getName(); ?> </p>
                    
                    <form method="POST" action="/dashboard">
                        <p>A rendre avant le : <?= $search[$key]->getEnd_date()->format('Y-m-d'); ?> </p>
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="date" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input type="submit" name="prolong" value="Prolonger">
                    </form>
                    <form action="">
                        <input type="submit" value="Rendre">
                    </form>
                    <hr>
                    
                </article> 
            <?php endforeach;
        }
        
    }?>



<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

