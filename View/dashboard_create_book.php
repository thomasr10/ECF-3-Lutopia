<?php
$title = "Dashboard - Création d'un livre | Lutopia";
$description = "Page de création d'un livre, sur le dashboard admin de Lutopia";
$pointSlash = "./";
$arrayJs = ["./assets/js/dashboard_create_book"];
ob_start();
?>

<div>
    <h2>Ajouter une oeuvre</h2>
    <form action="/dashboard-book" method="POST" enctype="multipart/form-data">
        <div>
            <label for="isbn">Numéro ISBN</label>
            <input type="number" name="isbn"  id="isbn" placeholder="Numéro ISBN" required>
        </div>
        <div>
            <label for="title">Titre du livre</label>
            <input type="text" name="title"  id="title" placeholder="Titre du livre" required>
        </div>
        <div id="author-section">
            <label for="author">Auteur</label>
            <input type="text" name="author"  id="author" placeholder="Auteur" required>
            <p>Créez l'auteur s'il n'existe pas</p>
        </div>
        <div id="illustrator-section">
            <label for="illustrator">Illustrateur</label>
            <input type="text" name="illustrator"  id="illustrator" placeholder="Illustrateur" required>
            <p>Créez l'illustrateur s'il n'existe pas</p>
        </div>
        <div>
            <label for="editor">Éditeur</label>
            <input type="text" name="editor"  id="editor" placeholder="Éditeur" required>
        </div>
        <div>
            <label for="publication_date">Date de publication</label>
            <input type="date" name="publication_date"  id="publication_date" required>
        </div>
        <div>
            <label for="edition_date">Date d'édition</label>
            <input type="date" name="edition_date"  id="edition_date" placeholder="Synopsis" required>
        </div>
        <div>
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" placeholder="Synopsis"></textarea>
        </div>
        <div>
            <label for="category">Catégorie</label>
            <select name="category" id="category">
                <option value="">Catégories</option>
                <?php
                foreach($categories as $category){
                ?>
                <option value="<?=$category->getId_category()?>"><?=$category->getCategory_name()?></option>
                <?php
                }
                ?>
            </select>
            <p>Créez la catégories si elle n'existe pas</p>
        </div>
        <div>
            <label for="age">Tranche d'âge</label>
            <select name="age" id="age">
                <option value="">Tranche d'âge</option>
                <?php
                foreach($ageRanges as $age){
                ?>
                <option value="<?=$age->getId_age()?>"><?=$age->getFrom()?> - <?=$age->getTo()?> ans</option>
                <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="type">Type de livre</label>
            <select name="type" id="type">
                <option value="">Type de livre</option>
                <?php
                foreach($types as $type){
                ?>
                <option value="<?=$type->getId_type()?>"><?=$type->getType_name()?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="state-0">État de l'exemplaire</label>
            <select name="state-0" id="state-0">
                <option value="">État de l'exemplaire</option>
                <option value="0">Très bon état</option>
                <option value="1">Bon état</option>
                <option value="2">Dégradé</option>
            </select>
        </div>
        <div>
            <label for="picture">Image du livre</label>
            <input type="file" accept="image/webp, image/png, image/jpeg, image/jpg" name="picture"  id="picture" placeholder="Synopsis" required>
        </div>
        <div>
            <input type="submit" value="Ajouter le livre">
        </div>
    </form>
</div>

<?php

$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_htmlA.php');
?>