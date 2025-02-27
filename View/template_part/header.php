<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <!-- LES FRONT : vous pouvez modifier la navbar. C'était juste pour tester les routes (il faudra bien les réutiliser si jamais vous faites des modif) -->
    <header>
        <nav>
            <ul>
                <li><a href="<?= $router->generate('home')?>">Accueil</a></li>
                <li><a href="#">Contact</a></li>
                <?php
                if(isset($_SESSION['id'])){
                ?>
                <li><a href="#">Mon profil</a></li>
                <li><a href="<?=$router->generate('logout') ?>">Se déconnecter</a></li>
                <?php
                } else {
                ?>
                <li><a href="<?=$router->generate('login') ?>">Se connecter</a></li>
                <li><a href="<?=$router->generate('register') ?>">S'inscrire</a></li>
                <?php    
                }
                ?>
            </ul>
        </nav>
    </header>
