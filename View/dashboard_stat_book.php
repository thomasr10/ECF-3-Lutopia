<?php
$title = "Statistiques livre | Lutopia";
$description = "Page de consultation des statistiques liées aux livres sur le dashboard admin de Lutopia";
$arrayJs = ['./assets/js/dashboard_stat_book.js'];
ob_start();

?>

<section class="dash-statbook-globalcontainer">
    <h2>Statistiques livres</h2>
    <div class="dash-form-container">
        <form method="GET" class="dash-statbook-search">
            <input type="text" name="" id="" placeholder="Rechercher..." />
            <button type="submit" class="">
                <img src="<?= UPLOADS . 'autres/icon-loupe.svg'?>" alt="icone loupe">
            </button>
        </form> 
        <select name="year" id="year">
            <option value=""></option>
        </select>
        <button type="reset">Réinitialiser</button>
    </div>
     
    <Article class="dash-statbook-container">
        <table class="dash-statbook-table">
            <thead class="dash-statbook-header">
              <th scope="col" class = "statbook-title">Titre du livre</th>  
              <th scope="col" class = "statbook-id">Id</th>  
              <th scope="col" class = "statbook-author">Auteur</th>  
              <th scope="col" class = "statbook-age">Age</th>  
              <th scope="col" class = "statbook-type">Type</th>  
              <th scope="col" class = "statbook-borrow">Emprunts</th>  
            </thead>
            <?php
            foreach($books as $book){
            ?>
            <tbody class="dash-statbook-body">
                <td class="dash-statbook-cellule"><?=$book->book->getTitle()?></td>
                 <!-- cellules titre livre -->
                <td class="dash-statbook-cellule"><?=$book->book->getId_book()?></td>
                <!-- cellules Id -->
                <td class="dash-statbook-cellule"><?=$book->author?></td>
                <!-- cellules Auteurs -->
                <td class="dash-statbook-cellule" value="<?=$book->age->getId_age()?>"><?=$book->age->getFrom()?>-<?=$book->age->getTo()?></td>
                <!-- cellules Ages -->
                <td class="dash-statbook-cellule"><?=$book->type->getType_name()?></td>
                <!-- cellules Types -->
                <td class="dash-statbook-cellule"><?=$book->count_borrow?></td>
                <!-- cellules emprunts -->
            </tbody>
            <?php
            }
            ?>
        </table>
    </Article>  
</section>


<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>