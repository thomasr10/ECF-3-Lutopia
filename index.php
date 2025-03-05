<?php
session_start();

require_once('./vendor/autoload.php');
require_once('./vendor/altorouter/altorouter/AltoRouter.php');

$router = new AltoRouter();


//ROUTES


//--- HOMEPAGE ---
// get children ages
$router->map('GET', '/', 'ControllerChild#home', 'home');
// display books depending on age
$router->map('GET', '/home-category-age/[i:age]', 'ControllerBook#homePage', 'home-page');
// display books depending on type
$router->map('GET', '/type/[i:age]/[i:type]/[i:category]', 'ControllerBook#typeBook', 'typeBook');

//show 1 book
$router->map('GET', '/book/[i:id]', 'ControllerBook#showOneBook', 'showOneBook');

//inscription
$router->map('GET|POST', '/register', 'ControllerUser#register', 'register');
$router->map('GET', '/confirmation/[i:id]', 'ControllerMail#sendMail', 'send-mail');
$router->map('GET',  '/new-mail/[i:id]', 'ControllerUser#newVerificationMail', 'new-mail');
$router->map('GET', '/confirm-user/[a:token]', 'ControllerUser#confirmUser', 'confirm-user');

//connexion
$router->map('GET|POST', '/login', 'ControllerUser#login', 'login');
//deconnexion
$router->map('GET', '/logout', 'ControllerUser#logout', 'logout');
$router->map('GET|POST', '/register-child', 'ControllerChild#registerChild', 'register-child');


//route age
$router->map('GET', '/age/[i:age]', 'ControllerBook#drawAge', 'drawAge');




$match = $router->match();

if(is_array($match)){
    list($controller, $action) = explode('#', $match['target']);
    
    $obj = new $controller();
    
    if(is_callable(array($obj, $action))){
        call_user_func_array(array($obj, $action), $match['params']);
        
    }

}