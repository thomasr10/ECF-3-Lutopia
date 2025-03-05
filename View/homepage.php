<?php

$title = "Accueil | Lutopia";
$description = "Page d'accueil de Lutopia";
$arrayJs = ["./assets/js/homepage.js"];
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
<!-- slider des nouveautés en fonction de l'age -->






<h1>Les dernières sorties</h1>

<div id="book-container"></div>
<?php
}
?>

<div id="section-container">
    
</div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>

