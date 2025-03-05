<?php 
$title = $ageInfos[0]->getFrom() . ' à ' . $ageInfos[0]->getTo() .' ans | Lutopia';
$arrayJs = ["../assets/js/type.js"];
$pointSlash = "../";
ob_start();
?>
<?= (isset($_SESSION['id'])) ? $_SESSION['first-name'] : '' ?>
    <h1>Tous les livres de <?=$ageInfos[0]->getFrom();?> à <?=$ageInfos[0]->getTo();?> ans</h1>
            <form action="#">
                <input id="page_age" type="hidden" value="<?= $ageInfos[0]->getId_age();?>">
                <div>
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
            <form action="#">
                <label for="category"></label>
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
                    <img src="../<?= $datas[$key]->book->getImg_Src() ?>" alt="" width="200px" height="200px"> <!-- image pour chaque livre --> 
                    <h2><?= $datas[$key]->book->getTitle(); ?> </h2> <!-- titre  --> 
                    <p> écrit par <?= $datas[$key]->author ?> <!-- auteur  --> 
                    <p> illustrée par <?= $datas[$key]->illustrator ?> <!-- illustrateur  --> 
                    <p>par les <?= $datas[$key]->book->getEditor();?></p> <!-- edition  --> 
                    
                </article>
            <?php endforeach ?>
        </div>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>