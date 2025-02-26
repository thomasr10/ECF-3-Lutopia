<?php 
$title = 'Accueil | Lutopia';
ob_start();
?>

    <h1>Bienvenue sur la page d'accueil</h1>
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