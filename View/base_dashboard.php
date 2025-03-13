<?php include_once('./View/template_part/headerA.php'); ?>
<!-- class dashboard => flex -->
<section class="dashboard">
    <!-- class side-bar à styliser | J'ai mis le contour en rouge juste pour montrer la taille qu'elle doit prendre à peu près (je me suis basé sur le figma), elle peut être aggrandi si besoin-->
    <div class="side-bar">
        <nav>
            <div>
               <h3>Gestion des livres</h3>
               <ul>
                <li><a href="">Statistiques livre</a></li>
                <li><a href="<?= $router->generate('create-book') ?>">Ajouter un livre</a></li>
                <li><a href="">Modifier un livre</a></li>
               </ul>
            </div>
            <div>
                <h3>Gestion des utilistaeurs</h3>
                <ul>
                    <li><a href="<?= $router->generate('dashboard') ?>">Statistiques utilisateur</a></li>
                    <li><a href="">Ajouter un utilistaeur</a></li>
                    <li><a href="">Modifier un utilisateur</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><a href="<?=$router->generate('logout') ?>">Se déconecter</a></li>
                </ul>                
            </div>
        </nav>
    </div>
    <!-- style du content à faire directement sur la page concernée -->
     <div>
        <?= $content ?>
     </div>
</section>
<?php include_once('./View/template_part/footerA.php'); ?>