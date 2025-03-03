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
</body>
</html>