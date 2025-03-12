<?php

$title = "Accueil | Lutopia";
$description = "Page d'accueil de Lutopia";
$arrayJs = ["./assets/js/homepage.js"];
$pointSlash = "";
ob_start();
?>
<?php
if(isset($_SESSION['id'])){
?>
<div>

    <?php
    if(!empty($borrow)){
    ?>
    <!-- afficher les livres réservé -->
    <?php
    } else {
    ?>
    <div>
        <p>Aucun livre réservé pour le moment</p>
    </div>
    <?php
    }
    ?>
</div>


<!-- début selection enfant et affichage de ses reservations -->
<section class = "reservation">
    <img src="uploads/autres/ours.svg" alt="icone d'ours">
   <div class = "child-select">

    
    <select name="select-child" id="select-child" class = "select-child">
    <?php
    foreach($datas as $child){
    ?>
    <option class="child" value="<?=date('Y')-$child->getBirth_date()->format('Y')?>"><?= $child->getName() ?></option>
    <?php
    }
    ?>
    </select>

   </div>
   <div class= "padding-element2">
   <div class= "mini-book">
   <img src="uploads/bebe_mon_amour.webp" class ="mini-book-img" alt= "miniature du livre">
    <div class="mini-book-title">
      <a href="">Bébé mon amour</a>
      <a href="">
      <img id="close-button" src="uploads/autres/iconX.svg" class = "close-x-icon"alt="icone fermeture"></a>
    </div>
    </div>
    
   </div > 











































</section>
<!-- fin selection enfant et affichage de ses reservations -->
<!-- carroussel -->

<div id="center">
    <h1>Les dernières sorties</h1>
    <div id="bookContainer"></div>
    <div class="buttons">
        <button class="button" id="prevButton"><img src="/uploads/autres/buttonCarrousselLeft.webp" alt="button left"> </button>
        <button class="button" id="nextButton"><img src="/uploads/autres/buttonCarrousselRight.png" alt="button right"></button>
    </div>
</div>

<div id="section-connected"></div>

<?php
} else {
?>
<!-- div qui comprend tous les livres -->
<div id="section-container">

<?php
    $count = 0;
    foreach(array_chunk($books, 4) as $chunk){
?>
<!-- div qui comprend l'image du dé + la rangée de livres associé -->
        <div class="bookRowCubeAge">
        <?php include "animation_{$count}.php"; ?>
        <div>


<div class="booksContainer">          
<?php foreach($chunk as $book){?>
                <div class="card">
                    <img src="<?=$book->book->getImg_src()?>" alt="Couverture du livre <?=$book->book->getTitle()?>">
                    <p><?=$book->book->getTitle()?></p>
                    <button class="button_pink">voir la fiche</button>
                    <button class="button_borrow">Réserver</button>
                </div>
            
<?php } ?>
</div>
</div>
<?php
        
        $count++;
    }
?>          
       </div> 
<?php } ?>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>

