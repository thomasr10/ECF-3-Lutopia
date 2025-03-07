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
            <label for="picture">Image webp</label>
            <input type="file" accept="image/webp" name="picture"  id="picture" placeholder="Synopsis" required>
        </div>
        <div>
            <label for="copy-number">Nombre de copies du livre</label>
            <input type="number" name="copy-number"  id="copy-number" placeholder="Nombre de copies du livre" min=1 required>
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