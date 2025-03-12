<?php

$title = "Dashboard | Lutopia";
$description = "Page dashboard de Lutopia";
$pointSlash = "";
ob_start();
?>


<body>


    <section class="dasboard-container-global">







        <section class="dashboard-container-left">
            <div class="dashboard-menu">
            <div class="dashboard-menu-link"><a href="">Gestion des livres</a></div>
            <div class="dashboard-menu-link"><a href="">Gestion des utilisateurs</a></div>
            <div class="dashboard-menu-link"><a href=""></a></div>
            </div>

        </section>





        <section class="dashboard-container-right"></section>
            <div class="identity"></div>
                <div>
                    <div>
                        <form method="GET" action="/dashboard">
                            <input type="text" name="searchAdminUser" id="searchAdminUser" value="">
                            <input type="submit" value="🔍">
                        </form>
                        <div>
                        champtexte
                        </div>
                    </div>
                        
                    
                    <div>
                    <select name="" id="" class = "">
                    </div>
                </div>
            <div class="reservation"></div>
            <div class="borrow"></div>







    </section>
    


<h2>Bienvenue dans le dashboard !</h2>
<li><a href="<?=$router->generate('logout') ?>">Se déconnecter</a></li>


<?php if(isset($_GET['searchAdminUser']) && !empty($_GET['searchAdminUser'])){ 
        if(!isset($search)){
            echo 'Aucune carte sélectionnée';
        } else {
            ?> 
            <hr>  <!-- hr a supprimer -->
            <h2>Réservation en cours</h2>
            <hr> <!-- hr a supprimer -->
           <?php 
           foreach($reservation as $key=>$value):
           ?>
           <p><?= $reservation[$key]->getTitle(); ?></p> <!-- titre de chaque livre réserver -->
           <?php 
           if($avaibility[$key][0]->getEnd_date()->format('Y-m-d') < $date){ // if bouton disponible ou else affichage indisponible
                echo '<form method="POST" action="/dashboard?searchAdminUser=' . $_GET['searchAdminUser'] . '">                                
                        <input type="submit" value="Disponible">     
                     </form>' ;
            } else {
                echo 'indisponible retour prévu le ' . $avaibility[$key][0]->getEnd_date()->format('d-m-Y'); // information indisponibilité du livre
            }
           ?> 
           <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>">
            <input type="hidden" name="id_reservation" value="<?= $avaibility[$key][0]->getId_reservation();?>">
            <input type="submit" name="cancel" value="Annuler">
           </form>
           <?php endforeach;
           echo 3 - count($reservation). ' reservations restantes'; //nombre de réservation restante ?>
           <hr> <!-- hr a supprimer -->
            <h2>Emprunt en cours</h2><hr><?php
            foreach($search as $key=>$value): ?>
                <?=$search[$key]->getLast_Name() //NOM DE L'USER POUR CHAQUE EMPRUNT ?>
                <article>
                    <p>Livre : <?= $search[$key]->getTitle(); ?> </p>  <!-- titre de chaque livre emprunter -->
                    <p>Emprunt de : <?= $search[$key]->getName(); ?> </p> <!-- nom de l'enfant de chaque livre emprunter -->
                    
                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>"> <!-- formulaire pour prolonger l'emprunt -->
                        <p>A rendre avant le : <?= $search[$key]->getEnd_date()->format('d-m-Y'); ?> </p> <!-- date de fin de l'emprunt -->
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="date" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>"> <!-- input date pour prolonger l'emprunt -->
                        <input type="submit" name="prolong" value="Prolonger"> <!-- bouton qui prolonge l'emprunt -->
                    </form>
                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>"> <!-- formulaire pour rendre un livre emprunter -->
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="hidden" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input type="submit" name="suppr" value="Rendre"> <!-- bouton rendre pour rendre un livre -->
                    </form>
                    <hr>
                    
                </article> 
            <?php endforeach;
        } 
        
    } else {
        echo 'Aucune carte séléctionner';  //texte si aucune carte n'est entrer mais que le formaire est quand même envoyer
    }
    
    ?>

</body>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');

