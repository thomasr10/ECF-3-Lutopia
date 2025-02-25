<?php 
$title = 'Accueil | Lutopia';
ob_start();
?>

    <h1>Bienvenue sur la page d'accueil</h1>
        <?php foreach($datas as $key=>$value){ ?>
            <article>
                <img src="./<?= $datas[$key]->getImg_Src() ?>" alt="" width="200px" height="200px">
                <h2><?= $datas[$key]->getTitle(); ?> </h2>
                <p>par les <?= $datas[$key]->getEditor();?></p>
            </article>
            <?php }?>
<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>