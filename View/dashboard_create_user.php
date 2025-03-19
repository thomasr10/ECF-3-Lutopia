<?php
$title = "Création utilisateur | Lutopia";
$description = "Page de création d'un utilisateur sur le dashboard admin de Lutopia";
$arrayJs = ["../assets/js/register.js"];
ob_start();

?>

<div>
    <h1>Créer un nouvel utilisateur</h1>
    <?= (isset($message)) ? $message : '' ?>
    <form action="/dashboard/create-user" method="POST">
        <div>
            <label for="first-name">Prénom</label>
            <input type="text" name="first-name" id="first-name" placeholder="Prénom" required>
        </div>
        <div>
            <label for="last-name">Nom</label>
            <input type="text" name="last-name" id="last-name" placeholder="Nom" required>
        </div>
        <div>
            <label for="email">Adresse mail</label>
            <input type="email" placeholder="Votre adresse mail" name="email" id="email" required>
        </div>
        <div id="child-section">
            <div>
                <label for="child-1">Enfant 1</label>
                <input type="text" name="child-name[]" id="child-1" placeholder="Prénom de l'enfant" minlength="2" required><br>
                <label for="birth-1">Date de naissance</label>
                <input type="date" id="birth-1" name="child-birth[]" placeholder="Date de naissance" required><br>
                <input type="button" id="add-child" value="Ajouter un enfant">           
            </div>
        </div>
        <div>
            <input type="submit" value="Valider">
        </div>
    </form>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_dashboard.php');
?>