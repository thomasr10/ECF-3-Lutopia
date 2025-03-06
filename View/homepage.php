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
    <span><?= $_SESSION['first-name']?></span> <!-- prénom du parent -->
    <select name="select-child" id="select-child">
    <?php
    foreach($datas as $child){
    ?>
    <option class="child" value="<?=date('Y')-$child->getBirth_date()->format('Y')?>"><?= $child->getName() ?></option>
    <?php
    }
    ?>
    </select>
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
<!-- carroussel -->

<div id="center">
    <h1>Les dernières sorties</h1>
    <div id="bookContainer"></div>
    <div class="buttons">
        <button class="button" id="prevButton"><img src="/uploads/autres/buttonCarrousselLeft.webp" alt="button left"> </button>
        <button class="button" id="nextButton"><img src="/uploads/autres/buttonCarrousselRight.png" alt="button right"></button>
    </div>
</div>
<div id="grid">
    <div class="des_0_2_ans"><img src="uploads/des_0_2_ans.webp" alt="0 à 2 ans"></div>
    <div class="slider_0_2_ans">
        <div class="card">
            <img src="uploads/horloge_des_souvenirs.webp" alt="horloge des souvenirs">
            <p class="titre"></p>
            <div id="buttonsCard">
            <button class="button_pink">voir la fiche</button>
            <button class="button_borrow">Réserver</button>
            </div>
        </div>
        <div class="card">Livre 2</div>
        <div class="card">Livre 3</div>
        <div class="card">Livre 4</div>
    </div>
    <div class="des_2_4_ans"><img src="uploads/des_2_4_ans.webp" alt="2 à 4 ans"></div>
    <div class="slider_2_4_ans">
        <div class="card">Livre 1</div>
        <div class="card">Livre 2</div>
        <div class="card">Livre 3</div>
        <div class="card">Livre 4</div>
    </div>
    <div class="des_4_6_ans"><img src="uploads/des_4_6_ans.webp" alt="4 à 6 ans"></div>
    <div class="slider_4_6_ans">
        <div class="card">Livre 1</div>
        <div class="card">Livre 2</div>
        <div class="card">Livre 3</div>
        <div class="card">Livre 4</div>
    </div>
    <div class="des_6_8_ans"><img src="uploads/des_6_8_ans.webp" alt="6 à 8 ans"></div>
    <div class="slider_6_8_ans">
        <div class="card">Livre 1</div>
        <div class="card">Livre 2</div>
        <div class="card">Livre 3</div>
        <div class="card">Livre 4</div>
    </div>
    <div class="des_8_10_ans"><img src="uploads/des_8_10_ans.webp" alt="8 à 10 ans"></div>
    <div class="slider_8_10_ans">
        <div class="card">Livre 1</div>
        <div class="card">Livre 2</div>
        <div class="card">Livre 3</div>
        <div class="card">Livre 4</div>
    </div>
</div>
<?php
}
?>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>

