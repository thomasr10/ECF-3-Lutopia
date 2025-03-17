<?php

$title = "Dashboard | Lutopia";
$description = "Page dashboard de Lutopia";
$pointSlash = "";
ob_start();
?>

<section class= "dash-accueil-global">
    <article class="dash-accueil-identification">
        <h2>UTILISATEUR</h2>

        <div class = "dash-accueil-user">
         
         <form class="dash-accueil-form" method="GET" action="/dashboard">
             <input type="text"name="searchAdminUser"           id="searchAdminUser" value="">
             <button type="submit" >
             <img src="uploads/autres/icon-loupe.svg" alt="">
             </button>
         </form>
         <div class="dash-accueil-user-name">
            Famille <?=$search[0]->getLast_Name() ?>
         </div>
        </div>
        <div class="dash-select-contain">
            <select name="id-child" id="id-child" class="dash-select-child">
                <option value="choisir l'enfant">choisir l'enfant</option>
            </select>
        </div>
    </article>

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
                        <input type="submit" value="Disponible"> ' ;
            } else {
                echo '
                <form method="POST" action="/dashboard?searchAdminUser=' . $_GET['searchAdminUser'] . '"> 
                <input class = "dash-disabled" type="submit" disabled value="Indisponible"> '; // information indisponibilité du livre
            }
            echo '</form>';
           ?> 

           <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>">
            <input type="hidden" name="id_reservation" value="<?= $avaibility[$key][0]->getId_reservation();?>">
            <input type="submit" name="cancel" value="Annuler">
           </form>
           <?php endforeach;
           echo 3 - count($reservation). ' reservations restantes'; //nombre de réservation restante ?>
           <hr> <!-- hr a supprimer -->

           <div class="dash-accueil-borrow">

            <h2>Emprunt(s) en cours</h2><hr>

            <?php
            foreach($search as $key=>$value): ?>
                    <!-- <?=$search[$key]->getLast_Name() ?> -->
                    <!-- NOM DE L'USER POUR CHAQUE EMPRUNT  -->

                    <div class="dash-accueil-titlebook-container">
                    <p class= "dash-accueil-titlebook" ><?= $search[$key]->getTitle(); ?> </p>  <!-- titre de chaque livre emprunter -->
                    <!-- <p>Emprunt de : <?= $search[$key]->getName(); ?> </p> -->
                     <!-- nom de l'enfant de chaque livre emprunter -->
                    
                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>"> <!-- formulaire pour prolonger l'emprunt -->
                        <p class="dash-date-color">A rendre avant le : <span><?= $search[$key]->getEnd_date()->format('d-m-Y');?></span></p> <!-- date de fin de l'emprunt -->
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                    </div>
                        <input type="date" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>"> <!-- input date pour prolonger l'emprunt -->
                        <input type="submit" name="prolong" value="Prolonger"> <!-- bouton qui prolonge l'emprunt -->
                    </form>

                    <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>"> <!-- formulaire pour rendre un livre emprunter -->
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="hidden" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input type="submit" name="suppr" value="Rendre"> <!-- bouton rendre pour rendre un livre -->
                    </form>
                    <hr>
             

            <?php endforeach;
        } 
        
    } else {
        echo 'Aucune carte séléctionner';  //texte si aucune carte n'est entrer mais que le formaire est quand même envoyer
    }
    
    ?>
</div>  
</section>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');

