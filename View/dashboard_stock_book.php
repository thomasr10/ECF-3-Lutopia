<?php
$title = "Dashboard - Gestion de stock | Lutopia";
$description = "Page de création de gestion du stock de livres sur le dashboard admin de Lutopia";
$arrayJs = ['../assets/js/dashboard_stock_book'];
ob_start();
?>
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
            <button type="button">Ajouter un exemplaire</button>
        </div>
        <div>
            <p>Nombre d'exemplaire(s) : <?= count($copies)?></p>
        </div>
    <?php
        foreach($copies as $copy){
        ?>
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
        <button type="button" disabled="true">Supprimer</button>
        <button class="button_pink modify-btn" type="button">Modifier</button>
        <button class="button_pink hidden" type="button">Valider</button>
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