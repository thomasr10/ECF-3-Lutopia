<?php
session_start();

require_once('./vendor/autoload.php');
require_once('./vendor/altorouter/altorouter/AltoRouter.php');

require_once('./config/config.php');

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

//reservation
$router->map('GET', '/[i:book]/[i:child]', 'ControllerChild#reservationBook', 'reservationBook');
$router->map('GET', '/[i:child]', 'ControllerChild#showReservation', 'showReservation');
$router->map('GET', '/remove/[i:reservation]', 'ControllerChild#removeReservation', 'removeReservation');

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

//utilisateur
$router->map('GET|POST', '/profil', 'ControllerUser#showProfil', 'showProfil');
$router->map('GET|POST', '/profil/parameter', 'ControllerUser#profilParameter', 'profilParameter');

//bibliotequaire
$router->map('GET|POST', '/login-admin', 'ControllerUser#loginAdmin', 'loginAdmin');
$router->map('GET|POST', '/dashboard', 'ControllerUser#dashboard', 'dashboard');
$router->map('GET|POST', '/dashboard/[i:child]', 'ControllerUser#dashboardChild', 'dashboardChild');
// gestion du stock

$router->map('GET|POST', '/dashboard-book/book-stock', 'ControllerBook#checkCopies', 'book-stock');


//Créer un livre
$router->map('GET|POST', '/dashboard-book', 'ControllerBook#createBook', 'create-book');

//modifier un livre
$router->map('GET|POST', '/dashboard-book/modify-book', 'ControllerBook#modifyBook', 'modify-book');

//Chercher un auteur
$router->map('POST', '/dashboard-search-author', 'ControllerAuthor#searchAuthor', 'search-author');
$router->map('POST', '/dashboard-search-illustrator', 'ControllerIllustrator#searchIllustrator', 'search-illustrator');


//Add author / illustrator
$router->map('POST', '/dashboard/add-author', 'ControllerAuthor#addAuthor', 'add-author');
$router->map('POST', '/dashboard/add-illustrator', 'ControllerIllustrator#addIllustrator', 'add-illustrator');

//route age
$router->map('GET', '/age/[i:age]', 'ControllerBook#drawAge', 'drawAge');

//route 404 error
$router->map('GET', '/error404', 'ControllerUser#errorPage', 'errorPage');

//route informations page
$router->map('GET', '/informations', 'ControllerUser#infoPage', 'infoPage');


//search-bar
$router->map('POST', '/search-book', 'ControllerBook#searchBook', 'search-book');

//gestion de stock
$router->map('POST', '/search-copies', 'ControllerBook#searchCopies', 'search-copies');
$router->map('GET', '/delete-book-copy/[i:id]', 'ControllerCopy#deleteCopy', 'delete-copy');
$router->map('POST', '/update-state', 'ControllerCopy#updateState', 'update-state');
$router->map('POST', '/add-copies', 'ControllerCopy#addCopies', 'add-copies');


// Statistiques livres

$router->map('GET', '/stat-books','ControllerBook#getStatsBook', 'get-stats');
$router->map('GET', '/stat-books/borrow-sortZ-A', 'ControllerBook#getStatsBookCountBorrowSortByAz');

// Création user dashboard
$router->map('GET|POST', '/dashboard/create-user', 'ControllerUser#registerUserFromDashboard', 'register-from-dashboard');

// mail validation user :

$router->map('GET', '/dashboard-validate-user/[i:id]', 'ControllerMail#confirmRegisterFromDashboard');
$router->map('GET|POST', '/create-password/[i:id]', 'ControllerUser#createPassword', 'create-password');

// modifier/ supprimer user

$router->map('GET|POST', '/dashboard/update-user', 'ControllerUser#updateUser', 'update-user');







$match = $router->match();

if(is_array($match)){
    list($controller, $action) = explode('#', $match['target']);
    
    $obj = new $controller();
    
;    if(is_callable(array($obj, $action))){
        call_user_func_array(array($obj, $action), $match['params']);
        
    }

} else {
    header('Location: /error404');
}