<?php 
$title = $ageInfos[0]->getFrom() . ' à ' . $ageInfos[0]->getTo() .' ans | Lutopia';
$arrayJs = [ASSETS . "js/type.js", ASSETS . "js/search-bar.js"];
$pointSlash = "../";
ob_start();
?>

<?php
if(isset($_SESSION['id'])){
?>
<section class = "reservation">
    <img src="<?= UPLOADS ?>autres/ours.svg" alt="icone d'ours">
    <div class = "child-select">

    

    <select name="select-child" id="select-child" class = "select-child">
    <?php
    foreach($datasChild as $child){
        if($child->getId_child() == $idchild){ 
    ?>
    <option class="child" value="<?=date('Y')-$child->getBirth_date()->format('Y')?>-<?= $child->getId_child(); ?>"><?= $child->getName() ?></option>
    <?php }
    }
    ?>

    </select>
    
   <!-- </div>
   <div class= "padding-element2">
   <div class= "mini-book">
   <img src="uploads/bebe_mon_amour.webp" class ="mini-book-img" alt= "miniature du livre">
    <div class="mini-book-title">
      <a href="">Bébé mon amour</a>
      <a href="">
      <img id="close-button" src="uploads/autres/iconX.svg" class = "close-x-icon"alt="icone fermeture"></a>
    </div>
    </div> -->
    
        <select disabled name="select-child" id="select-child" class = "select-child">
            <?php
            foreach($datasChild as $child){             // boucle pour chercher les enfants en fonction de l'user
                if($child->getId_child() == $idchild){ 
            ?>
                    <option class="child" value="<?=date('Y')-$child->getBirth_date()->format('Y')?>-<?= $child->getId_child(); ?>"><?= $child->getName() ?></option>   <!-- calcul de l'âge de l'enfant préfixer avec l'id de l'enfant ainsi que le nom dans les balises options -->
            <?php }
            }
            ?>
        </select>

   </div >
   

</section>

<?php } ?>

    <div id="titrePageAge">
    <h1>Tous les livres de <?=$ageInfos[0]->getFrom();?> à <?=$ageInfos[0]->getTo();?> ans</h1> <!-- age de (0-8) à (2-10) en fonction de la route appeler-->
    </div>
    <!-- filtre -->
     <div id="formFiltre">
            <form action="#" id="filtre">
                <input id="page_age" type="hidden" value="<?= $ageInfos[0]->getId_age();?>"> <!-- informations pour le js id age de la page -->
                <div class="selectionFiltre">       
                    <label for="0">Voir tous</label>        <!-- assignation de la valeur 0 pour tous voir par défaut -->
                    <input type="radio" name="type" id="0"> <!-- assignation de la valeur 0 pour tous voir par défaut -->
                </div>
                <?php foreach($radioDatas as $radio=>$radioValue):?>
                <div>
                    <label for="<?= $radioDatas[$radio]->getId_type();?>"><?= $radioDatas[$radio]->getType_name();?></label> <!-- assignation de l'id type puis du nom du type pour chaque label relier au input radio -->
                    <input type="radio" name="type" id="<?= $radioDatas[$radio]->getId_type();?>"> <!-- assignation de l'id type à chaque input radio -->
                </div>
                <?php endforeach ?>
            </form>
    </div>
    <!-- filtre catégories -->
            <form action="#" class="categoryFiltre">
                <label for="category" class="labelFiltre"></label>
                <select name="category" default class="categoryFiltrer">    <!-- select qui génère une option pour chaque catégorie -->
                    <option value="0">Toutes les catégories</option>    <!-- option par défaut voir toute les categorie -->
                    <?php foreach($categoryDatas as $category=>$categoryValue): ?>  <!-- génération de toute les category -->
                        <option value="<?= $categoryDatas[$category]->getId_category();?>"><?= $categoryDatas[$category]->getCategory_name();?></option>    <!-- id de la categorie ainsi que le nom de chaque categorie -->
                    <?php endforeach ?>
                </select>
            </form>
        <div id="containerArticle">
            <?php foreach($datas as $key=>$value): ?>  <!-- génération de tous les livres par défaut avec un aucun filtre séléctionner --> 
                <article class="card">
                    <img src="<?= UPLOADS . str_replace("/uploads/", "", $datas[$key]->book->getImg_Src()) ?>" alt="" width="200px" height="200px"><!-- image pour chaque livre --> 
                    <p><?= $datas[$key]->book->getTitle(); ?> </p> <!-- titre  --> 
                    <a href="/book/<?= $datas[$key]->book->getId_book(); ?>" class="button_pink">voir la fiche</a>  <!-- redirection voir page du livre -->
                    <button class="button_borrow" value="<?= $datas[$key]->book->getId_book(); ?>">Réserver</button>   <!-- ajouter le livre au réservation de l'enfant -->
                </article>
            <?php endforeach ?>
        </div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>