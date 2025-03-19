<?php 
$title = $ageInfos[0]->getFrom() . ' à ' . $ageInfos[0]->getTo() .' ans | Lutopia';
$arrayJs = ["../assets/js/type.js", "../assets/js/search-bar.js"];
$pointSlash = "../";
ob_start();
?>
    <div id="titrePageAge">
    <h1>Tous les livres de <?=$ageInfos[0]->getFrom();?> à <?=$ageInfos[0]->getTo();?> ans</h1>
    </div>
    <!-- filtre -->
     <div id="formFiltre">
            <form action="#" id="filtre">
                <input id="page_age" type="hidden" value="<?= $ageInfos[0]->getId_age();?>">
                <div class="selectionFiltre">
                    <label for="0">Voir tous</label>
                    <input type="radio" name="type" id="0">
                </div>
                <?php foreach($radioDatas as $radio=>$radioValue):?>
                <div>
                    <label for="<?= $radioDatas[$radio]->getId_type();?>"><?= $radioDatas[$radio]->getType_name();?></label>
                    <input type="radio" name="type" id="<?= $radioDatas[$radio]->getId_type();?>">
                </div>
                <?php endforeach ?>
            </form>
    </div>
    <!-- filtre catégories -->
            <form action="#" class="categoryFiltre">
                <label for="category" class="labelFiltre"></label>
                <select name="category" default id="">
                    <option value="0">Toutes les catégories</option>
                    <?php foreach($categoryDatas as $category=>$categoryValue): ?>
                        <option value="<?= $categoryDatas[$category]->getId_category();?>"><?= $categoryDatas[$category]->getCategory_name();?></option>
                    <?php endforeach ?>
                </select>
            </form>
        <div id="containerArticle">
            <?php foreach($datas as $key=>$value): ?>
                <article>
                    <div class="card">
                    <img src="../<?= $datas[$key]->book->getImg_Src() ?>" alt="" width="200px" height="200px"><!-- image pour chaque livre --> 
                    <h2><?= $datas[$key]->book->getTitle(); ?> </h2> <!-- titre  --> 
                    <button class="button_pink">voir la fiche</button>
                    <button class="button_borrow">Réserver</button>   
                </div>
                    
                </article>
            <?php endforeach ?>
        </div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>