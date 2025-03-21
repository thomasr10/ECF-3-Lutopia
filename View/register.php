<?php

$title = "Inscription | Lutopia";
$description = "Page d'inscription de Lutopia";
$arrayJs = ["./assets/js/register.js"];
$pointSlash = "";
ob_start();

?>
<!-- MESSAGE D'ERREUR -->
<div>
    <p><?= (isset($message)) ? $message : '' ?></p>
</div>
    <div id="grid2">
        <form action="/register" method="POST">
        <div id="register">
           
                <label for="first-name">Prénom</label>
                <input type="text" placeholder="Votre prénom" name="first-name" id="first-name" required>
            
           
                <label for="name">Nom de famille</label>
                <input type="text" placeholder="Votre nom de famille" name="name" id="name" required>
          
            
                <label for="email">Adresse mail</label>
                <input type="email" placeholder="Votre adresse mail" name="email" id="email" required>
          
         
              
                    <label for="child-1">Enfant 1</label>
                    <input type="text" name="child-name[]" id="child-1" placeholder="Prénom de l'enfant" minlength="2" required><br>
                    <label for="birth-1">Date de naissance</label>
                    <input type="date" id="birth-1" name="child-birth[]" placeholder="Date de naissance" required><br>
                    <input type="button" id="add-child" value="Ajouter un enfant">           
               
        
           
                <label for="password">Votre mot de passe</label>
                <input type="password" placeholder="Votre mot de passe" name="password" id="password" required> 
            
          
                <label for="confpassword">Confirmez votre mot de passe</label>
                <input type="password" placeholder="Confirmez votre mot de passe" name="confpassword" id="confpassword" required> 
            
          
                <input type="submit" value="S'inscrire">
            
         </div>
        </form>

<div id="book">
        <span class="page turn"></span>
        <span class="page turn"></span>
        <span class="page turn"></span>
        <span class="page turn"><img src="uploads/autres/Bienvenue.webp"></span>
        <span class="page turn"><img src="uploads/le_voyage_magique_de_timothee.webp"></span>
        <span class="page turn"></span>
        <span class="cover"></span>
        <span class="page"></span>
        <span class="cover turn"></span>
    </div>
</div>


<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>