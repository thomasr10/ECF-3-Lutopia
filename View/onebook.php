<?php 

$title = $bookInfo[0]->book->getTitle() . ' | Lutopia';
$description = $bookInfo[0]->book->getSynopsis();
$arrayJs = ["../assets/js/search-bar.js"];
$pointSlash = "../";

ob_start();

?>
<section class="onebook-global">
    <article>
        <figure class = "onebook-img">
            <img src="../<?= $bookInfo[0]   ->book->getImg_Src() ?>" alt="couverture du livre" > <!-- image   pour chaque livre --> 
        </figure>
        <div class="onebook-resume">

            <h2><?= $bookInfo[0]->book->getTitle(); ?> </h2> <!-- titre  --> 
            <p class = "onebook-synopsis"><?= $bookInfo[0]->book->getSynopsis(); ?></p>

            <div class = "onebook-line">
            <p class = "onebook-creator"> Auteur(s): </p> <!-- auteur  -->
            <span class="onebook-subject"><?= $bookInfo[0]->author ?></span>
            </div>

            <div class = "onebook-line">
            <p class = "onebook-creator"> Illustrateur(s):  </p> <!-- illustrateur  -->
            <span class="onebook-subject"><?= $bookInfo[0]->illustrator ?></span>
            </div>
            <div class = "onebook-line">
            <p class = "onebook-creator"> Maison d'édition:  </p> <!-- edition  -->
            <span class="onebook-subject"><?= $bookInfo[0]->book->getEditor();?></span>
            </div>
            <div class = "onebook-line">
            <p class = "onebook-creator"> Année de sortie:   </p> <!-- date de sortie  -->
            <span class="onebook-subject"><?= $bookInfo[0]->book->getPublication_date()->format('Y');?></span>
            </div> 
            <div class = "onebook-line">
            <p class = "onebook-creator"> ISBN:   </p> <!-- date de sortie  -->
            <span class="onebook-subject"><?= $bookInfo[0]->book->getIsbn();?></span>
            </div>
            <div class="onebook-button-contain">
                <button class = "onebook-reserver" type="button" id= "">Réserver</button>
            </div>


        </div>

    </article>
</section>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>