<?php
$title = "Dashboard - Création d'un livre | Lutopia";
$description = "Page de création d'un livre sur le dashboard admin de Lutopia";
$pointSlash = "./";
$arrayJs = ["./assets/js/dashboard_create_book"];
ob_start();
?>

<div id="modal-author" class="modal">
    <h2>Ajouter un(e) auteur(ice)</h2>
    <form action="/dashboard-book">
        <div>
            <label for="author-first-name">Prénom</label>
            <input type="text" name="author-first-name" id="author-first-name" placeholder="Prénom" required>
        </div>
        <div>
            <label for="author-last-name">Nom de famille</label>
            <input type="text" name="author-last-name" id="author-last-name" placeholder="Nom de famille" required>
        </div>
        <div>
            <input type="submit" name="add-author" id="add-author" value="Ajouter">
        </div>
    </form>
</div>

<div id="modal-illustrator" class="modal">
    <h2>Ajouter un(e) illustrateur(ice)</h2>
    <form action="/dashboard-book">
        <div>
            <label for="illustrator-first-name">Prénom</label>
            <input type="text" name="illustrator-first-name" id="illustrator-first-name" placeholder="Prénom" required>
        </div>
        <div>
            <label for="illustrator-last-name">Nom de famille</label>
            <input type="text" name="illustrator-last-name" id="illustrator-last-name" placeholder="Nom de famille" required>
        </div>
        <div>
            <input type="submit" name="add-illustrator" id="add-illustrator" value="Ajouter">
        </div>
    </form>
</div>

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
            <button id="author-btn" type="button">Ajouter un(e) auteur(ice)</button>
        </div>
        <div id="illustrator-section">
            <label for="illustrator">Illustrateur</label>
            <input type="text" name="illustrator"  id="illustrator" placeholder="Illustrateur" required>
            <button id="illustrator-btn" type="button">Ajouter un(e) illustrateur(ice)</button>
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
        <div id="category-section">
            <!-- DIV A FLEX POUR AVOIR LES SELECTS SUR LA MEME LIGNE -->
            <label for="category">Catégorie</label>
            <select name="category[]" id="category"> 
                <option value=""></option>
                <?php
                foreach($categories as $category){
                ?>
                <option value="<?=$category->getId_category()?>"><?=$category->getCategory_name()?></option>
                <?php
                }
                ?>
            </select>
            <p>Créez la catégories si elle n'existe pas</p>
            <select name="category[]" id="category-2">
            <option value=""></option>
                <?php
                foreach($categories as $category){
                ?>
                <option value="<?=$category->getId_category()?>"><?=$category->getCategory_name()?></option>
                <?php
                }
                ?>
            </select>
            <select name="category[]" id="category-3">
            <option value=""></option>
                <?php
                foreach($categories as $category){
                ?>
                <option value="<?=$category->getId_category()?>"><?=$category->getCategory_name()?></option>
                <?php
                }
                ?>
            </select>
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
            <label for="copy">Nombre d'exemplaires</label>
            <input type="number" name="copy" id="copy" placeholder="Nombre d'exemplaires" step=1>
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