<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <!-- Lien vers les fichiers CSS -->
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/layout/_footer.scss"> 
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <!-- Footer principal -->
    <footer class="footer">
        <!-- Section 1 : Nous contacter -->
        <div class="footer-section">
    <h4>Nous contacter</h4>

    <!-- Groupe 1 : Hôtel de la Métropole -->
    <div class="contact-group">
        <p class="highlight">Hôtel de la Métropole</p>
        <p><i class="fas fa-map-marker-alt icon-address"></i> 26 rue de la Métropole</p>
        <p>69003 LYON</p>
    </div>

    <!-- Groupe 2 : Horaires d'ouverture -->
    <div class="contact-group">
        <p class="highlight">Horaires d'ouverture au public :</p>
        <p>Du lundi au vendredi de 9h à 18h30</p>
    </div>

    <!-- Groupe 3 : Nous joindre par téléphone -->
    <div class="contact-group">
        <p class="highlight">Nous joindre par téléphone :</p>
        <p><strong>04 78 63 40 40</strong></p>
        <p>Du lundi au vendredi de 7h30 à 11h30</p>
    </div>
</div>

        <!-- Section 2 : Liens utiles et FAQ -->
        <div class="footer-section2">
            <h4>Liens utiles</h4>
           
            <h4>FAQ</h4>
            <p>Ressources Documentaires</p>
            <p>Espace Presse</p>
        </div>

        <!-- Section 3 : Suivez-nous et Newsletter -->
        <div class="footer-section3">
            <h4>Suivez-nous</h4>

            <!-- Icônes des réseaux sociaux -->
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank" aria-label="Meta">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://twitter.com" target="_blank" aria-label="X">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="https://www.youtube.com" target="_blank" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>

            <!-- Formulaire de newsletter -->
            <form id="newsletter-form">
                <button type="submit">S'inscrire à la Newsletter</button>
                <p class="feedback-message" id="feedback-message"></p>
            </form>
        </div>
    </footer>

    <!-- Liens en bas du footer -->
    <div class="bottom-links">
        <a href="#">Plan du site</a>
        <a href="#">Mentions légales</a>
        <a href="#">Accessibilité</a>
        <a href="#">Flux RSS</a>
        <a href="#">Gestion des cookies</a>
    </div>

    <!-- Script JS -->
    <script src="/assets/js/Newsletter.js" defer></script>
</body>
</html>
