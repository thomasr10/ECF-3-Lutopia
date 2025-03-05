<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $pointSlash ?>assets/css/style.css">
</head>
<body>
  <!-- LES FRONT : vous pouvez modifier la navbar. C'était juste pour tester les routes (il faudra bien les réutiliser si jamais vous faites des modif) -->
  <header class = "header">
    <div class = "menu">
      <figure>
        <img src="uploads/Logo-flat.svg" alt="Logo Lutopia">
      </figure>


      <nav>
        
      <div>
        <ul class = "navbar">
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
      </div>
      </nav>
      <form action="" method="GET" class="search-form">
      <input type="text" name="query" placeholder="Rechercher..."      class="search-input" />
        <button type="submit" class="search-button search-form">🔍</button>
  </form>
    </div>
   
  </header>
