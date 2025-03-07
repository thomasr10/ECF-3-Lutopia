<?php
session_start();

require_once('./vendor/autoload.php');
require_once('./vendor/altorouter/altorouter/AltoRouter.php');

$router = new AltoRouter();

// load .env files
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//ROUTES


//--- HOMEPAGE ---
// get children ages
$router->map('GET', '/', 'ControllerChild#home', 'home');
// display books depending on age
$router->map('GET', '/home-category-age/[i:age]', 'ControllerBook#homePage', 'home-page');
$router->map('GET', '/type/[i:age]/[i:type]/[i:category]', 'ControllerBook#typeBook', 'typeBook');
$router->map('POST', '/home-section', 'ControllerBook#displayBooks', 'display-books');

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

//bibliotequaire
$router->map('GET|POST', '/login-admin', 'ControllerUser#loginAdmin', 'loginAdmin');
$router->map('GET|POST', '/dashboard', 'ControllerUser#dashboard', 'dashboard');


//route age
$router->map('GET', '/age/[i:age]', 'ControllerBook#drawAge', 'drawAge');

//route 404 error
$router->map('GET', '/error404', 'ControllerUser#errorPage', 'errorPage');

//route informations page
$router->map('GET', '/informations', 'ControllerUser#infoPage', 'infoPage');




$match = $router->match();

if(is_array($match)){
    list($controller, $action) = explode('#', $match['target']);
    
    $obj = new $controller();
    
    if(is_callable(array($obj, $action))){
        call_user_func_array(array($obj, $action), $match['params']);
        
    }

} else {
    header('Location: /error404');
}