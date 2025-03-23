<?php
$title = "Statistiques livre | Lutopia";
$description = "Page de consultation des statistiques liées aux livres sur le dashboard admin de Lutopia";
$arrayJs = ['./assets/js/dashboard_stat_book.js'];
ob_start();

?>

<section class="dash-statbook-globalcontainer">
    <div>
        <h2>Statistiques livres</h2>
        <?php
            if(!isset($_GET['book'])){
            ?>
            <?php
            }
            ?>          
    </div>

    <div>
        <div class="dash-form-container" id="form-container">
            <form method="GET" class="dash-statbook-search">
                <input class ="input-correction" type="text" name="book" id="search" placeholder="  Rechercher..." />
                <button type="submit" class="">
                    <img src="<?= UPLOADS . 'autres/icon-loupe.svg'?>" alt="icone loupe">
                </button>
            </form> 
        
        <div>
        <select name="year" id="year">
                <option value="0">Depuis Toujours</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
        </div>
        </div>
        <?php
        if(isset($_GET['book'])){
        ?>
        <div><a href="<?= $router->generate('get-stats')?>">Retour</a></div>
        <?php
        }
        ?>  
    </div>

     
    <Article class="dash-statbook-container">
        <table class="dash-statbook-table">
        <caption id="sub-title">Les 20 livres les plus empruntés : </caption>
            <thead class="dash-statbook-header">
              <th scope="col" class = "statbook-title">Titre du livre</th>  
              <th scope="col" class = "statbook-id">Id</th>  
              <th scope="col" class = "statbook-author">Auteur</th>  
              <th scope="col" class = "statbook-age">Age</th>  
              <th scope="col" class = "statbook-type">Type</th>  
              <th scope="col" class = "<?= isset($_GET['book']) ? '' : 'statbook-borrow' ?>">Emprunts <?= isset($_GET['book']) ? '' : '↓' ?></th>  
            </thead>
            <?php
            if(isset($_GET['book'])){
            ?>
                <tbody class="dash-statbook-body">
                    <td class="dash-statbook-cellule title-cell"><?=$book->book->getTitle()?></td>
                    <!-- cellules titre livre -->
                    <td class="dash-statbook-cellule id-cell"><?=$book->book->getId_book()?></td>
                    <!-- cellules Id -->
                    <td class="dash-statbook-cellule author-cell"><?=$book->author?></td>
                    <!-- cellules Auteurs -->
                    <td class="dash-statbook-cellule age-cell" value="<?=$book->age->getId_age()?>"><?=$book->age->getFrom()?>-<?=$book->age->getTo()?></td>
                    <!-- cellules Ages -->
                    <td class="dash-statbook-cellule type-cell"><?=$book->type->getType_name()?></td>
                    <!-- cellules Types -->
                    <td class="dash-statbook-cellule count-cell"><?=$book->count_borrow?></td>
                    <!-- cellules emprunts -->
                </tbody>
            <?php
            } else {
                foreach($books as $book){
                ?>
                <tbody class="dash-statbook-body">
                    <td class="dash-statbook-cellule title-cell"><?=$book->book->getTitle()?></td>
                    <!-- cellules titre livre -->
                    <td class="dash-statbook-cellule id-cell"><?=$book->book->getId_book()?></td>
                    <!-- cellules Id -->
                    <td class="dash-statbook-cellule author-cell"><?=$book->author?></td>
                    <!-- cellules Auteurs -->
                    <td class="dash-statbook-cellule age-cell" value="<?=$book->age->getId_age()?>"><?=$book->age->getFrom()?>-<?=$book->age->getTo()?></td>
                    <!-- cellules Ages -->
                    <td class="dash-statbook-cellule type-cell"><?=$book->type->getType_name()?></td>
                    <!-- cellules Types -->
                    <td class="dash-statbook-cellule count-cell"><?=$book->count_borrow?></td>
                    <!-- cellules emprunts -->
                </tbody>
            <?php
                }
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