<div class="footer-background">
<footer class="footer">
        <div class="footer-section">
            <h4>Nous contacter</h4>
            <p>Hôtel de la Métropole</p>
            <p><i class="fas fa-map-marker-alt icon-address"></i> 26 rue de la Métropole</p>
            <p>68003 LYON</p>
            <p>Horaires d'ouverture au public :</p>
            <p>Du lundi au vendredi de 9h à 18h30</p>
            <p>Nous joindre par téléphone : <strong>04 78 63 40 40</strong></p>
           
        </div>
        <div class="footer-section2">
            <h4>Liens utiles</h4>
            <h4>FAQ</h4>
        </div>
        <div class="footer-section3">
            <h4>Suivez-nous</h4>
            <div class="social-icons">
                <a href="#"><img src="<?= UPLOADS ?>/autres/icons8-méta.svg" alt="Meta"></a>
                <a href="#"><img src="<?= UPLOADS ?>/autres/icons8-twitter.svg" alt="X"></a>
                <a href="#"><img src="<?= UPLOADS ?>/autres/icons8-youtube.svg" alt="YouTube"></a>
                <a href="#"><img src="<?= UPLOADS ?>/autres/icons8-instagram.svg" alt="Instagram"></a>

                <form id="newsletter-form">
                <input type="email" name="email" placeholder="Votre email" required>
                <button type="submit">S'inscrire à la Newsletter</button>
                <p class="feedback-message" id="feedback-message"></p>
                </form>
            </div>
        </div>

    
    <div class="bottom-links">
            <a href="#">Plan du site</a>
            <a href="#">Mentions légales</a>
            <a href="#">Accessibilité</a>
            <a href="#">Flux RSS</a>
            <a href="#">Gestion des cookies</a>
    </div>
</footer>
</div>
<!-- <script src="./assets/js/register.js"></script> -->
<?php
if(isset($arrayJs)){
foreach($arrayJs as $js){
?>
<script src="<?= $js ?>"></script>
<?php
}
}
?>
<script  src="<?=  ASSETS  ?>js/menuBurger.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/Flip.min.js"></script>

</body>
</html>