<footer>

</footer>

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