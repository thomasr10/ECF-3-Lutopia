<?php
$title = "Statistiques livre | Lutopia";
$description = "Page de consultation des statistiques liées aux livres sur le dashboard admin de Lutopia";
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
            <tbody class="dash-statbook-body">
                <td class="dash-statbook-cellule">tchoupi a la ferme</td>
                 <!-- cellules titre livre -->
                <td class="dash-statbook-cellule">test2</td>
                <!-- cellules Id -->
                <td class="dash-statbook-cellule">test3</td>
                <!-- cellules Auteurs -->
                <td class="dash-statbook-cellule">test4</td>
                <!-- cellules Ages -->
                <td class="dash-statbook-cellule">test5</td>
                <!-- cellules Types -->
                <td class="dash-statbook-cellule">test5</td>
                <!-- cellules emprunts -->
            </tbody>

        </table>
    </Article>  
</section>


<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>