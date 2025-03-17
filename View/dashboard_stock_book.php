<?php
$title = "Dashboard - Gestion de stock | Lutopia";
$description = "Page de création de gestion du stock de livres sur le dashboard admin de Lutopia";
$arrayJs = ['../assets/js/dashboard_stock_book'];
ob_start();
?>
<h1>Gestion du stock</h1>

<!-- CONFIRMATION SUPPRESSION -->
<div class="modal" id="modal-delete-copy">
    <p>Êtes-vous sûr(e) de vouloir supprimer cet exemplaire ?</p>
    <button id="confirm-delete" type="button">Confirmer</button>
</div>


<!-- AJOUT DES COPIES -->

<div class ="modal" id="modal-add-copies">
    <!-- titre du livre -->
    <h2><?= $_GET['title'] ?></h2>
    <p>Combien d'exemplaires souhaitez-vous ajouter ?</p>
    <form>
        <label for="add-copies">Nombre d'exemplaires à ajouter</label>
        <input type="number" name="add-copies" id="add-copies" min=1 step=1 placeholder="Nombre d'exemplaires à ajouter" required>
        <button class="button_pink" type="button" id="add-new-copies" value="<?= $_GET['id_book']?>">Ajouter</button>
    </form>
</div>

<!-- Début de la page (code au dessus = modal) -->
<div>
    <div id="search-form">
        <form method="GET" action="/dashboard-book/book-stock">
            <div id="book-datas">
                <label for="title">Rechercher par titre ou ISBN</label>
                <input type="text" id="title" name="title" placeholder="Rechercher par titre ou ISBN" required>
            </div>
                <input type="submit" value="🔍">
            </div>
        </form>    
    </div>

    <?php
    if(isset($copies)){
    ?>
        <div>
            <h3>Titre : <?= $_GET['title'] ?></h3>
            <button type="button" id="add-copies-btn" class="button_pink">Ajouter un exemplaire</button>
        </div>
        <p>Nombre d'exemplaire(s) : <?= count($copies)?></p>

        <!--  Début de la partie "tableau" -->
    <?php
        foreach($copies as $copy){
        ?>
        <div>
            <p>Id exemplaire : <?= $copy->getId_copy() ?></p>
            <?php
            // condition pour l'affichage de l'état de l'exemplaire
            switch($copy->getState()){
                case 0:
                    echo '<select name="state" disabled="true">' .
                            '<option value="'. $copy->getState() . '">Neuf</option>' .
                            '<option value="'. 1 . '">Bon état</option>' .
                            '<option value="'. 2 . '">Dégradé</option>' .
                        '</select>';
                    break;
                
                case 1:
                    echo '<select name="state" disabled="true">' .
                            '<option value="0" disabled="true">Neuf</option>' .
                            '<option value="'. $copy->getState() . '">Bon état</option>' .
                            '<option value="'. 2 . '">Dégradé</option>' .
                        '</select>';
                    break;
                case 2:
                    echo '<select name="state" disabled="true">' .
                            '<option value="0" disabled="true">Neuf</option>' .
                            '<option value="1" disabled="true">Bon état</option>' .
                            '<option value="'. $copy->getState() . '">Dégradé</option>' .
                        '</select>';
                    break;
            }
            ?>
            <button class="delete-btn" type="button" disabled="true">Supprimer</button>
            <button value="<?= $copy->getId_copy()?>" class="button_pink modify-btn" type="button">Modifier</button>
            <button class="button_pink hidden validate-btn" type="button">Valider</button>            
        </div>

        <?php
        }
    }
    ?>    
</div>


<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>