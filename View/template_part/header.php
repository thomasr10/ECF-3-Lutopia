<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?=  ASSETS . 'css/style.css' ?>">
    <link rel="shortcut icon" href="./uploads/autres/Logo-flat.svg" type="image/x-icon">
</head>
<body>
  <!-- LES FRONT : vous pouvez modifier la navbar. C'était juste pour tester les routes (il faudra bien les réutiliser si jamais vous faites des modif) -->
  <header class = "header">
    <div class = "menu">
      <button class="menu-toggle" aria-label="Menu burger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>
    
      <figure>
        <img src="<?= UPLOADS . '/autres/Logo-flat.svg'?>" alt="Logo Lutopia">
      </figure>

      <!-- <nav class ="nav">        -->
        <ul class = "navbar">
          <li><a href="<?= $router->generate('home')?>">Accueil</a></li>
          <li><a href="<?= $router->generate('infoPage')?>">Informations</a></li>
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
      <!-- </nav>  -->
      
      
      
     <div id="search-container">
        <form method="GET" class="search-form">
          <input type="text" name="query" id="query" placeholder="Rechercher..."      class="search-input" />

          <button type="submit" class="search-button">
              <img src="<?= UPLOADS . 'autres/icon-loupe.svg'?>" alt="icone loupe">
          </button>
        </form>      
     </div>
    </div>
  </header> 

