<?php
$title = "Dashboard - Modifier un livre | Lutopia";
$description = "Modifier'un livre sur le dashboard admin de Lutopia";
$arrayJs = ['../assets/js/dashboard_modify_book'];
ob_start();
?>
<h1>Modifier un livre</h1>
<div id="search-form">
    <form method="GET" action="/dashboard-book/modify-book">
        <div id="book-datas">
            <label for="title">Rechercher par titre ou ISBN</label>
            <input type="text" id="title" name="title" placeholder="Rechercher par titre ou ISBN" required>
        </div>
        <div>
            <input type="submit" value="🔍">
        </div>
    </form>    
</div>

<?php
if(isset($_GET['id_book'])){
?>
<div>
    <img src="<?= $book[0]->book->getImg_src() ?>" alt="Couverture du livre <?=$book[0]->book->getTitle() ?>" width="200px">
    <p>Titre : <?=$book[0]->book->getTitle() ?></p>
    <p>Isbn : <?=$book[0]->book->getIsbn() ?></p>
    <p>Éditeur : <?=$book[0]->book->getEditor() ?></p>
    <p>Date de publication : <?=$book[0]->book->getPublication_date()->format('d/m/Y') ?></p>
    <p>Date d'édition : <?=$book[0]->book->getEdition_date()->format('d/m/Y') ?></p>
    <p>Synopsis : <?=$book[0]->book->getSynopsis() ?></p>
    <p>Nombre d'exemplaires : <?= count($copies)?></p>
    <button id="modify-input" type="button">Modifier</button>
</div>

<div id="modal-modify-book" class="modal">
<!-- Modification livre -->
    <form action="/dashboard-book/modify-book" method="POST">
    <div>
            <label for="isbn">Numéro ISBN</label>
            <input type="number" name="isbn"  id="isbn" value="<?=$book[0]->book->getIsbn() ?>" required>
        </div>
        <div>
            <label for="title">Titre du livre</label>
            <input type="text" name="title"  id="title" value="<?=$book[0]->book->getTitle() ?>" required>
        </div>
        <div id="author-section">
            <label for="author">Auteur</label>
            <input type="text" name="author"  id="author" value="<?=$book[0]->author ?>" required>
        </div>
        <div id="illustrator-section">
            <label for="illustrator">Illustrateur</label>
            <input type="text" name="illustrator"  id="illustrator" value="<?=$book[0]->illustrator ?>" required>
        </div>
        <div>
            <label for="editor">Éditeur</label>
            <input type="text" name="editor"  id="editor" value="<?=$book[0]->book->getEditor() ?>" required>
        </div>
        <div>
            <label for="publication_date">Date de publication</label>
            <input type="date" name="publication_date"  id="publication_date" value="<?=$book[0]->book->getPublication_date()->format('Y-m-d') ?>" required>
        </div>
        <div>
            <label for="edition_date">Date d'édition</label>
            <input type="date" name="edition_date"  id="edition_date" value="<?=$book[0]->book->getEdition_date()->format('Y-m-d')?>" required>
        </div>
        <div>
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" ><?=$book[0]->book->getSynopsis() ?></textarea>
        </div>
        <div>
            <input type="hidden" name="id_book" value="<?= $book[0]->book->getId_book()?>">
            <input type="submit" name="modify-book" value="Valider">
        </div>
    </form>
</div>

<?php
} else {

}
?>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>