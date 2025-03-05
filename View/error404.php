<?php 

$title = '404 | Lutopia';
$description = 'Trying to access page that doesnt exist';
$arrayJs;
$pointSlash = "";

ob_start();

?>

    <h2 style="font-size: 150px;color:red;background-color:orange;">ERROR 404 TRYING TO ACCESS PAGE THAT DOESNT EXIST</h2>  <!--STYLE A SUPPRIMER PROVISOIRE-->

<?php 
$content = ob_get_contents();
ob_end_clean();
require_once('./View/base_html.php');
?>