<?php 

$title = $bookInfo[0]->book->getTitle() . ' | Lutopia';
$description = $bookInfo[0]->book->getSynopsis();
$arrayJs;
$pointSlash = "../";

ob_start();

?>

    <article>
        <img src="../<?= $bookInfo[0]->book->getImg_Src() ?>" alt="" width="200px" height="200px"> <!-- image pour chaque livre --> 
        <h2><?= $bookInfo[0]->book->getTitle(); ?> </h2> <!-- titre  --> 
        <p><?= $bookInfo[0]->book->getSynopsis(); ?></p>
        <p> Auteur(s): <?= $bookInfo[0]->author ?> <!-- auteur  --> 
        <p> Illustrateur(s):  <?= $bookInfo[0]->illustrator ?> <!-- illustrateur  --> 
        <p> Maison d'édition:  <?= $bookInfo[0]->book->getEditor();?></p> <!-- edition  --> 
        <p> Année de sortie:   <?= $bookInfo[0]->book->getPublication_date()->format('Y');?></p> <!-- date de sortie  --> 
        <p> ISBN:   <?= $bookInfo[0]->book->getIsbn();?></p> <!-- date de sortie  --> 
    </article>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>