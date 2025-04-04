<?php

$title = "Dashboard | Lutopia";
$description = "Page dashboard de Lutopia";
$pointSlash = "";
$arrayJs = ["./assets/js/dashboard_user_stat.js"];
ob_start();
?>

<section class= "dash-accueil-global">
    <article class="dash-accueil-identification">
        <h2>UTILISATEUR</h2>

        <div class = "dash-accueil-user">
         
         <form class="dash-accueil-form" method="GET" action="/dashboard">
             <input type="text"name="searchAdminUser" id="searchAdminUser" value="" placeholder="entrez ici le n° d'abonné" required>
             <!-- champ de recherche d'utilisateur par carte d'adhérent -->
             <button type="submit" >
                <img src="uploads/autres/icon-loupe.svg" alt="">    <!-- bouton rechercher -->
             </button>
         </form>
            <div class="dash-accueil-user-name">
                <?php if(!empty($search)){?><span>FAMILLE : </span><?php echo $search[0]->getLast_Name(); } ?>
            </div>
        </div>

<?php if(isset($_GET['searchAdminUser']) && !empty($_GET['searchAdminUser'])){ 
 ?>
<div class="dash-select-contain">
        
            <form id="child" method="POST" action="/dashboard?searchAdminUser=<?= $_GET['searchAdminUser'] ?>">
                <select name="id-child" id="id-child" class="dash-select-child">
                    <?php foreach($child as $key=>$value): ?> <!-- boucle pour récupérer les informations des enfant par rapport au user -->
                        <option <?php if(isset($_POST['id-child']) && $_POST['id-child'] == $child[$key]->getId_child()){ echo 'selected'; }?> value="<?= $child[$key]->getId_child()?>"><?= $child[$key]->getName()?></option> <!-- condition pour savoir quel champs doit être selected ainsi que l'id child en value et le nom de l'enfant dans les balises options -->
                    <?php endforeach ?>
                </select>
            </form>   
        </div>
    </article>
<?php
        if(!isset($search)){
            echo 'Aucune carte sélectionnée';
        } else {
            ?> 
            <div class="dash-accueil-borrow">
                
            <h2>Réservation(s) en cours</h2>
            
           <?php 
           foreach($reservation as $key=>$value):
           ?>
           <div class="dash-accueil-reserv-contain">
            <p><?= $reservation[$key]->getTitle(); ?></p> <!-- titre de chaque livre réserver -->

                <?php 
                if(!empty($copyDispo[$key])){ // condition pour la disponibilité d'un livre en fonction des copies du livre réservé
                        echo '<form class= "dash-form-reserv" method="POST" action="/dashboard?searchAdminUser=' . $_GET['searchAdminUser'] . '">
                                <input type="hidden" name="reservation_id" value="' . $reservation[$key]->getId_reservation() . '">  
                                <input type="hidden" name="copy_id" value="' . $copyDispo[$key] . '">
                                <input type="hidden" name="child_id" value="' . $_POST['id-child'] . '">                               
                                <button class = "dash-dispo" type="submit" name="toBorrow">Disponible
                                <img src="uploads/autres/keyboard_return.svg" alt="">
                                </button> '; // formulaire avec l'id reservation une copie disponible et id de l'enfant pour pouvoir transformer la réservation en emprunt 
                    } else {
                        echo '
                        <form method="POST" action="/dashboard?searchAdminUser=' . $_GET['searchAdminUser'] . '"> 
                        <button class = "dash-disabled" type="submit" disabled value="Indisponible">Indisponible  <img src="uploads/autres/keyboard_return.svg" alt=""></button> '; // information indisponibilité du livre
                    }
                    echo '</form>';
                ?> 

            <form method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>">
                <input type="hidden" name="id_reservation" value="<?= $reservation[$key]->getId_reservation();?>"> 
                <input class= "dash-input-annuler" type="submit" name="cancel" value="Annuler">     <!-- formulaire qui envoie une suppression de réservation avec l'id -->
            </form>
           </div>
           <?php endforeach;
           echo 3 - count($reservation). ' reservations restantes'; //nombre de réservation restante ?>
            </div>
            
           <div class="dash-accueil-borrow">

            <h2>Emprunt(s) en cours</h2>

            <?php
            foreach($search as $key=>$value): ?>
            <div class="dash-accueil-borrow-contain">
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
                    <div class="dash-accueil-borrow-date">
                        <div class="dash-accueil-date-container">
                        <input class="dash-date-choose" type="date" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>"> <!-- input date pour prolonger l'emprunt -->
                        <input class="dash-date-prolong "  type="submit" name="prolong" value="Prolonger"> <!-- bouton qui prolonge l'emprunt -->
                        </div>
                    </form>

                    <form class="dash-accueil-borrow-rendre" method="POST" action="/dashboard<?= '?searchAdminUser=' . $_GET['searchAdminUser'] ?>"> <!-- formulaire pour rendre un livre emprunter -->
                        <input type="hidden" name="id_borrow" value="<?= $search[$key]->getId_borrow()?>">
                        <input type="hidden" name="date_back" value="<?= $search[$key]->getEnd_date()->format('Y-m-d');?>">
                        <input class = "input-correction " type="submit" name="suppr" value="Rendre"> <!-- bouton rendre pour rendre un livre -->
                    </form>
                    
                    </div>
            </div> 

            <?php endforeach;
        } 
        
    } else {
        echo 'Aucune carte séléctionnée';  //texte si aucune carte n'est entrer mais que le formaire est quand même envoyer
    }
    
    ?>
</div>  
</section>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>