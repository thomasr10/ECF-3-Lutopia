<?php include_once('./View/template_part/headerA.php'); ?>
<!-- class dashboard => flex -->
<section class="dashboard">
    <!-- class side-bar à styliser | J'ai mis le contour en rouge juste pour montrer la taille qu'elle doit prendre à peu près (je me suis basé sur le figma), elle peut être aggrandi si besoin-->
    <div class="side-bar">
        <nav>
            <div>
               <h3 class = "dashboard-title">Gestion des livres</h3>
               <ul class = "dashboard-list">
                <li class = "dashboard-link"><a href="">Statistiques livre</a></li>
                <li class = "dashboard-link"><a href="<?= $router->generate('create-book') ?>">Ajouter un livre</a></li>
                <li class = "dashboard-link"><a href="<?= $router->generate('modify-book') ?>">Modifier un livre</a></li>
                <li class = "dashboard-link"><a href="<?= $router->generate('book-stock') ?>">Gestion du stock</a></li>
               </ul>
            </div>
            <div>
                <h3 class = "dashboard-title">Gestion des utilisateurs</h3>
                <ul class = "dashboard-list">
                    <li class = "dashboard-link"><a href="<?= $router->generate('dashboard') ?>">Statistiques utilisateur</a></li>
                    <li class = "dashboard-link"><a href="">Ajouter un utilisateur</a></li>
                    <li class = "dashboard-link"><a href="">Modifier un utilisateur</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class = "dashboard-link dashboard-deconnexion"><a href="<?=$router->generate('logout') ?>">Se déconnecter</a></li>
                </ul>                
            </div>
        </nav>
    </div>
    <!-- style du content à faire directement sur la page concernée -->
     <div class="content-side">
        <?= $content ?>
     </div>
</section>
<?php include_once('./View/template_part/footerA.php'); ?>