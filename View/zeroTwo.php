<?php 
$title = 'Jusqu\'à 2 ans | Lutopia';
ob_start();
?>
<?= (isset($_SESSION['id'])) ? $_SESSION['first-name'] : '' ?>
    <h1>Tous les livres jusqu'à 2 ans</h1>
        <form action="#">
            <?php foreach($radioDatas as $radio=>$radioValue):?>
            <div>
                <label for="<?= $radioDatas[$radio]->getId_type();?>"><?= $radioDatas[$radio]->getType_name();?></label>
                <input type="radio" name="type" id="<?= $radioDatas[$radio]->getId_type();?>">
            </div>
            <?php endforeach ?>
        </form>
        <?php foreach($datas as $key=>$value){ ?>
            <article>
                <img src="./<?= $datas[$key]->book->getImg_Src() ?>" alt="" width="200px" height="200px"> <!-- image pour chaque livre --> 
                <h2><?= $datas[$key]->book->getTitle(); ?> </h2> <!-- titre  --> 
                <p> écrit par <?= $datas[$key]->author ?> <!-- auteur  --> 
                <p> illustrée par <?= $datas[$key]->illustrator ?> <!-- illustrateur  --> 
                <p>par les <?= $datas[$key]->book->getEditor();?></p> <!-- edition  --> 
                
            </article>
            <?php }?>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>