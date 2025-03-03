<?php
// CETTE VUE EST AFFICHEE S'IL Y A EU UN PB A L'INSCRIPTION  DES ENFANTS (SI QQN A TENTE D'INSCRIRE UN ENFANT QUI A PLUS DE 12 ANS)
$title = "Inscription des enfants | Lutopia";
$description = "Page pour inscrire ses enfants s'il y a eu un problème lors de la première tentative d'inscription.";
$arrayJs = ["./assets/js/register.js"];
ob_start();
?>
<div>
    <p>Au moins un des enfants dépasse l'âge requis pour valider l'inscription. Pour rappel l'âge maximum est 12 ans.</p>
</div>
<form action="/register-child" method="POST">
    <div id="child-section">
        <div>
            <label for="child-1">Enfant 1</label>
            <input type="text" name="child-name[]" id="child-1" placeholder="Prénom de l'enfant" minlength="2" required>
            <label for="birth-1">Date de naissance</label>
            <input type="date" id="birth-1" name="child-birth[]" placeholder="Date de naissance" required>
            <input type="button" id="add-child" value="Ajouter un enfant">           
        </div>
    </div>
    <div>
        <input type="submit" value="Inscription">
    </div>
</form>

<?php
$content = ob_get_contents();
ob_end_clean();
require_once('View/base_html.php');
?>