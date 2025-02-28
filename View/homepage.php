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
    <span><?= $_SESSION['first-name']?></span>
    <select name="select-child" id="select-child">
    <?php
    foreach($datas as $child){
    ?>
    <option value="<?=date('Y')-$child->getBirth_date()->format('Y')?>"><?= $child->getName() ?></option>
    <?php
    }
    ?>
    </select>
</div>
<div>

</div>
<?php
}
?>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>

