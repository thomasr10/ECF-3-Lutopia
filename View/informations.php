<?php 

$title = 'Informations | Lutopia';
$description = 'Informations page of Lutopia with many info of how this website work';
$arrayJs;
$pointSlash = "";

ob_start();

?>

    <article>
        <h2>INFORMATIONS</h2>
        <p>Lutopia est une bibliothèque spécialement conçue pour les enfants de 0 à 10 ans. Ici, nous éveillons le plaisir de la lecture à travers des livres adaptés, des animations ludiques et un espace chaleureux pensé pour les jeunes lecteurs et leurs familles.</p>

        <h2>✨ Comment s'inscrire ?</h2>
        <p>L'inscription est gratuite et réservée aux enfants de 0 à 10 ans, sous la responsabilité d'un parent ou d'un tuteur légal.
        <p>Pour inscrire votre enfant, il suffit de fournir :</p>
        <p>📄 Une pièce d'identité du parent ou du tuteur</p>
        <p>🏡 Un justificatif de domicile de moins de trois mois</p>
        <p>📝 Un formulaire d'inscription signé (disponible sur place ou en ligne)</p>
        <p>La carte de bibliothèque permet d'emprunter des livres et de participer aux activités proposées.</p>

        <h2>📖 Emprunter des livres</h2>

        <p>📚 Chaque enfant peut emprunter jusqu'à 3 livres pour une durée de 3 semaines.</p>
        <p>🔄 Prolongation possible une fois, sauf si le livre est réservé.</p>
        <p>📢 En cas de retard, un rappel sera envoyé aux parents.</p>

        <p>⏰ Horaires d'ouverture</p>
        <p>🕰️ Du lundi au vendredi : 7h30 - 18h30</p>
        <p>📅 Fermé les week-ends et jours fériés</p>

        <h2>🎭 Nos services et animations</h2>

        <p>Lutopia est bien plus qu'une bibliothèque : un espace d'éveil et de découverte !

        <p>🌟 Espace bébé-lecteur (0-3 ans) : tapis d'éveil, livres sensoriels et comptines</p>
        <p>📖 L'Heure du conte : lectures animées et interactives chaque semaine</p>
        <p>✂️ Ateliers créatifs : coloriage, bricolage et petits jeux autour des histoires</p>
        <p>🎧 Découverte du livre numérique : contes audio et albums interactifs</p>
        <p>📚 Clubs de lecture (6-10 ans) : discussions et jeux autour de leurs livres préférés</p>
        <p>🎭 Spectacles et animations spéciales : marionnettes, lectures théâtralisées, rencontres avec des auteurs jeunesse</p>

        <h2>📜 Règles de la bibliothèque</h2>

        <p>Pour que chaque enfant profite pleinement de l'espace, nous vous remercions de respecter ces règles :</p>
        <p>✔ Les enfants doivent être accompagnés d'un adulte (sauf activités spécifiques mentionnées).</p>
        <p>✔ Nous respectons le silence et les autres lecteurs.</p>
        <p>✔ Les livres sont nos amis : on les manipule avec soin.</p>
        ✔ Pas de nourriture ni de boissons à proximité des livres.</p>

        <h2>📍 Contact & Accès</h2>

        <p>
        <p>📌 Adresse :Hôtel de la Métropole</p>
        <p>20 rue du Lac</p>
        <p>69003 LYON</p>
        <p>📞 Téléphone : 04 78 63 40 40</p>
        <p>📧 Email :lutopia@gmail.com</p>
        <p>🚍 Accès : Parking hôtel de ville à proximité, bus 21 et métro arrêt hôtel de ville</p>
        <p>📖 Rejoignez Lutopia pour un voyage merveilleux dans l'univers des livres ! 🌟</p>
    </article>

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>