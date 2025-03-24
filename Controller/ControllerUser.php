<?php

class ControllerUser {
    
    public function register(){

        global $router;
        $model = new ModelUser();
        $model->isConnected();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $user = $model->checkUser($_POST['email']);
            if($user){
                $message = "Adresse mail déjà existante";
                require_once('./View/register.php');
            } else {
                if(!empty($_POST['first-name']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confpassword'])&& !empty($_POST['child-name']) && !empty($_POST['child-birth'])){
                    //Check if more than 1 child
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[?.!+*-_&*]).{8,}$/";

                        $arrayChild = [];
                        //associate child name with child birth
                        for($i = 0; $i < count($_POST['child-name']); $i++){
                            $arrayChild[] = [
                                "name" => $_POST['child-name'][$i],
                                "birth" => $_POST['child-birth'][$i]
                            ];
                        }

                        if($_POST['password'] === $_POST['confpassword'] && preg_match($pattern, $_POST['password'])){
                            $hashed_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                            $token = bin2hex(random_bytes(50));
                            $lastId = $model->newUser($_POST['first-name'], $_POST['name'], $_POST['email'], $hashed_pass, $token);
                            
                            if($lastId){
                                $id = intval($lastId);

                                //generate card with id , first name and name
                                $card = strtoupper(substr($_POST['first-name'], 0, 2)) . $id . strtoupper(substr($_POST['name'], 0, 2));
                                $model->updateUser($card, $id);
                                
                                //check child age, has to be under 10 yo
                                $modelChild = new ModelChild();
                                $diff = 10;
                                $years = $modelChild->yearDiff($arrayChild, $diff);

                                //Pour récup les infos de la session si pb à l'inscription d'un enfant
                                $_SESSION['id'] = $id;
                                $_SESSION['first-name'] = $_POST['first-name']; 
                                $_SESSION['last-name'] = $_POST['name'];
                                $_SESSION['full-name'] = $_POST['first-name'] . ' ' . $_POST['name'];  
                                
                                foreach($years as $year){
                                    if($year !== null){
                                        $modelChild->newChild($id, $arrayChild);                    
                                    } else {
                                       header('Location: /register-child');
                                       exit();
                                    }
                                }
                                header('Location: /confirmation/' . $id);
                                exit();
                            } else {
                                $message = "Problème lors de l'inscription";
                                require_once('./View/register.php');
                            }       
                        } else {
                            $message = "Mots de passe différents ou insuffisants";
                            require_once('./View/register.php');                    
                        }
                    } else {
                        $message = "Adresse mail invalide";
                        require_once('./View/register.php');
                    }
                } else {
                    $message = "Tous les champs doivent être remplis";
                    require_once('./View/register.php');
                }
            }

        } else {
            require_once('./View/register.php');
        }
    }

    public function newVerificationMail(int $id){
        $model = new ModelUser();
        $token = bin2hex(random_bytes(50));
        $model->updateToken($id, $token);
        header('Location: /confirmation/' . $id);
        exit();
    }

    public function confirmUser(string $token){
        global $router;
        $url = $_SERVER['REQUEST_URI'];
        $part = explode('/', $url);
        $token = end($part);
        $model = new ModelUser();
        $user = $model->checkUserByToken($token);

        if($user){
            $email = $user->getEmail();
            $model->validateUser($email);
            header('Location: /');
            exit();
        } else {
            require_once('./View/confirm-token.php');
        }
    }


    public function login(){

        global $router;
        $model = new ModelUser();
        $model->isConnected();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['email']) && !empty($_POST['password'])){

                $user = $model->checkUserByEmail($_POST['email']);

                if($user && password_verify($_POST['password'], $user->getPassword())){
                    
                    $_SESSION['id'] = $user->getId_user();
                    $_SESSION['first-name'] = $user->getFirst_name();
                    $_SESSION['last-name'] = $user->getLast_name();
                    $_SESSION['full-name'] = $user->getFirst_Name() . ' ' . $user->getLast_Name();
                    $_SESSION['role'] = $user->getRole();

                    // remember me
                    if(isset($_POST['Check1'])){
                        setcookie("remember_mail", $_POST['email'], time() + 3600*24*30);
                        setcookie("remember", $_POST['Check1'], time() + 3600*24*30);
                    } else {
                        setcookie("remember_mail", '', time() - 36000);
                        setcookie("remember", '', time() - 3600);
                    }

                    header('Location: /');
                    exit();
                } else {
                    $message = "Adresse mail ou mot de passe incorrect";
                    require_once('View/login.php');
                }
            } else {
                $message = "Veuillez remplir tous les champs";
                require_once('View/login.php');                
            }


        } else {
            require_once('View/login.php');
        }
    }

    public function loginAdmin(){
        global $router;
        $model = new ModelUser();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){

                $admin = $model->checkAdmin($_POST['name'], $_POST['email']);

                if($admin && password_verify($_POST['password'], $admin->getPassword())){

                    if($admin->getRole() == 1){

                        $_SESSION['id'] = $admin->getId_user();
                        $_SESSION['role'] = $admin->getRole();
                        $_SESSION['first-name'] = $admin->getFirst_name();
                        $_SESSION['last-name'] = $admin->getLast_name();
                        $_SESSION['full-name'] = $admin->getFirst_Name() . ' ' . $admin->getLast_Name();
                        header('Location: /dashboard');
                        
                    } else {
                        $message = "Vos droits sont insuffisants";
                        require_once('View/loginAdmin.php'); 
                    }
                } else {
                    $message = "Adresse mail ou mot de passe incorrect";
                    require_once('View/loginAdmin.php'); 
                }
            } else {
                $message = "Veuillez remplir tous les champs";
                require_once('View/loginAdmin.php'); 
            }
        } else {
            require_once('./View/loginAdmin.php');
        }
    }

    public function dashboard(){
        if(isset($_SESSION['role'])){
            global $router;
            
            if(isset($_GET['searchAdminUser'])){
                $model = new ModelUser();
                $child = $model->getChildByCard($_GET['searchAdminUser']);
                if(!isset($_POST['id-child'])){
                    $_POST['id-child'] = (string)$child[0]->getId_child();
                }

                $search = $model->getBorrowByCard($_GET['searchAdminUser'], $_POST['id-child']);
                
                $reservation = $model->getReservationByCard($_GET['searchAdminUser'], $_POST['id-child']);

                $avaibility = [];
                $copyDispo = [];
                foreach($reservation as $book=>$value){
                   $avaibility = $model->getAvailability($reservation[$book]->getId_book());
                   foreach($avaibility as $key=>$value){
                        $copy = $model->getBorrowCopy($avaibility[$key]->getId_copy());
                        if(empty($copy)){
                            $copyDispo[$book] =  $avaibility[$key]->getId_copy();        
                        }
                   } 
                }
            
                
                $date = new DateTime();
                $date = $date->format('Y-m-d');
                
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toBorrow'])){
                $model = new ModelUser();
                $getResInfo = $model->reservationToBorrow($_POST['reservation_id']);
                $insertBorrow = $model->createBorrow($_POST['child_id'], $_POST['copy_id']);
                $search2 = $model->deleteReservation($_POST['reservation_id']);
                $search = $model->getBorrowByCard($_GET['searchAdminUser'], $_POST['id-child']);
                $reservation = $model->getReservationByCard($_GET['searchAdminUser'], $_POST['id-child']);
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])){
                $model = new ModelUser();
                $search2 = $model->deleteReservation($_POST['id_reservation']);
                $reservation = $model->getReservationByCard($_GET['searchAdminUser'], $_POST['id-child']);
                $avaibility = [];
                $copyDispo = [];
                foreach($reservation as $book=>$value){
                   $avaibility = $model->getAvailability($reservation[$book]->getId_book());
                   foreach($avaibility as $key=>$value){
                        $copy = $model->getBorrowCopy($avaibility[$key]->getId_copy());
                        if(empty($copy)){
                            $copyDispo[$book] =  $avaibility[$key]->getId_copy();        
                        }
                   } 
                }
                $search = $model->getBorrowByCard($_GET['searchAdminUser'], $_POST['id-child']);
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prolong'])){
                $model = new ModelUser();
                $search2 = $model->updateBorrow($_POST['id_borrow'], $_POST['date_back']);
                $search = $model->getBorrowByCard($_GET['searchAdminUser'], $_POST['id-child']);
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suppr'])){
                $model = new ModelUser();
                $search2 = $model->deleteBorrow($_POST['id_borrow'], $_POST['date_back']);
                $search = $model->getBorrowByCard($_GET['searchAdminUser'], $_POST['id-child']);
            }
            require_once('./View/dashboard.php');
        } else {
            header('Location: /');
        }
    }

    public function dashboardChild($child){
        global $router;
        header('Content-Type: application/json');
        json_encode($child);
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    }

    public function errorPage(){
        global $router;
        require_once('./View/error404.php');
    }

    public function infoPage(){
        global $router;
        require_once('./View/informations.php');
    }

    public function showProfil(){
        global $router;
        $model = new ModelUser();
        if(isset($_SESSION['id'])){
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])){
                $delete = $model->deleteReservation($_POST['id_reservation']);
            }
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tri']) && $_GET['tri'] != 0){
                if($_GET['tri'] == 1){
                    $info = $model->getInfoChildByUser($_SESSION['id'], $_GET['tri']);
                    $borrow = $model->getBorrowByUser($_SESSION['id'], $_GET['tri']);
                    $borrowHistory = $model->getBorrowByUserHistory($_SESSION['id'], $_GET['tri']);
                    $reservation = $model->getReservationByUser($_SESSION['id'], $_GET['tri']);
                }
                if($_GET['tri'] == 2){
                    $info = $model->getInfoChildByUser($_SESSION['id'], $_GET['tri']);
                    $borrow = $model->getBorrowByUser($_SESSION['id'], $_GET['tri']);
                    $borrowHistory = $model->getBorrowByUserHistory($_SESSION['id'], $_GET['tri']);
                    $reservation = $model->getReservationByUser($_SESSION['id'], $_GET['tri']);
                }
                if($_GET['tri'] == 3){
                    $info = $model->getInfoChildByUser($_SESSION['id'], $_GET['tri']);
                    $borrow = $model->getBorrowByUser($_SESSION['id'], $_GET['tri']);
                    $borrowHistory = $model->getBorrowByUserHistory($_SESSION['id'], $_GET['tri']);
                    $reservation = $model->getReservationByUser($_SESSION['id'], $_GET['tri']);
                }
            } else {
                $info = $model->getInfoChildByUser($_SESSION['id']);
                $borrow = $model->getBorrowByUser($_SESSION['id'], 0);
                $borrowHistory = $model->getBorrowByUserHistory($_SESSION['id'], 0);
                $reservation = $model->getReservationByUser($_SESSION['id'], 0);
            }
            require_once('./View/profil.php');
        } else {
            header('Location: /');
        }
    }

    public function profilParameter(){
        global $router;
        $model = new ModelUser();
        $user = $model->getUserById($_SESSION['id']);
        if(isset($_SESSION['id'])){
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeinfo'])){
                if(!empty($_POST['first-name']) && !empty($_POST['last-name']) && !empty($_POST['email'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $updateInfo = $model->updateInfo($_SESSION['id'], $_POST['first-name'], $_POST['last-name'], $_POST['email']);  
                        $user = $model->getUserById($_SESSION['id']);
                        $message = "Info mise à jour avec succès"; 
                    } else {
                        $message = "L'email n'est pas au bon format"; 
                    }
                } else {
                    $message = "Des champs sont vides"; 
                }
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changepass'])){
                if(!empty($_POST['latepass']) && !empty($_POST['newpass']) && !empty($_POST['newpass2'])){
                    $passverify = $model->getPasswordUser($_SESSION['id']);
                    if($passverify && password_verify($_POST['latepass'], $passverify->getPassword())){
                        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[?.!+*-_&*]).{8,}$/";
                        if($_POST['newpass'] === $_POST['newpass2'] && preg_match($pattern, $_POST['newpass'])){
                            $hash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
                            $updatePass = $model->updatePassword($hash, $_SESSION['id']);
                            $message = "Mise à jour avec succès!";
                        } else {
                            $message = "Mot de passe incorrect";  
                        }
                    } else {
                        $message = "Mot de passe incorrect";
                    }
                } else {
                    $message = "Des champs sont vides"; 
                }
            }

            require_once('./View/parameter.php');
        } else {
            header('Location: /');
        }
    }


    public function registerUserFromDashboard(){
        global $router;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['first-name']) && !empty($_POST['last-name']) && !empty($_POST['email']) && !empty($_POST['child-name']) && !empty($_POST['child-birth'])){
                $model = new ModelUser();
                $user = $model->checkUser($_POST['email']);

                if($user){
                    $message = "Adresse mail déjà existante";
                    require_once('./View/register.php');

                } else {
                    
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $id = $model->addUserFromDashboard($_POST['first-name'], $_POST['last-name'], $_POST['email']);

                        if($id){
                            //generate card with id , first name and name
                            $card = strtoupper(substr($_POST['first-name'], 0, 2)) . $id . strtoupper(substr($_POST['last-name'], 0, 2));
                            $model->updateUser($card, $id);
                            $arrayChild = [];

                            for($i = 0; $i < count($_POST['child-name']); $i++){
                                $arrayChild[] = [
                                    "name" => $_POST['child-name'][$i],
                                    "birth" => $_POST['child-birth'][$i]
                                ];
                            }

                            //check child age  
                            $modelChild = new ModelChild();
                            $diff = 10;
                            $years = $modelChild->yearDiff($arrayChild, $diff);
                            // si age validé -> insert child

                            $_SESSION['id_user'] = $id;
                            foreach($years as $year){
                                if($year !== null){
                                    $modelChild->newChild($id, $arrayChild);                    
                                } else {
                                   header('Location: /register-child');
                                   exit();
                                }
                            }

                            header('Location: /dashboard-validate-user/' . $id);
                            exit();
                            
                        } else {
                            $message = 'Problème survenu lors de l\'inscription';
                            require_once('./View/dashboard_create_user.php');   
                        }

                    } else {
                        $message = 'Adresse mail invalide';
                        require_once('./View/dashboard_create_user.php');            
                    }

               
                }

                
                
            } else {
                $message = 'Veuillez remplir tous les champs.';
                require_once('./View/dashboard_create_user.php');
            }
        } else {
            require_once('./View/dashboard_create_user.php');
        }
    }


    public function createPassword(int $id){
        // création de mdp user après l'inscription côté admin
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['password']) && !empty($_POST['confpassword'])){
                
                $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[?.!+*-_&*]).{8,}$/";

                if($_POST['password'] === $_POST['confpassword'] && preg_match($pattern, $_POST['password'])){
                    
                    $hashed_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

                    $model = new ModelUser();
                    $model->createPassword($hashed_pass, $id);
                    
                    header('Location: /login');
                    exit();

                } else {
                    $message = 'Mot de passe différents ou insuffisants';
                    require('./View/create_password.php');
                }
            }

        } else {

            require('./View/create_password.php');
        }
    }

    public function updateUser(){
        global $router;
        
        $modelUser = new ModelUser();
        $modelChild = new ModelChild();
        $diff = 10;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(isset($_POST['update-user']) && !isset($_POST['new-child-name'])){
                // je me sers de ces méthodes pour récupérer les infos de la bdd
                $user = $modelUser->getUserById($_POST['id_user']);
                $children = $modelChild->getChildByUser($user->getId_user());

                // je crée un tabeleau associatif avec les infos du users
                $currentUserInfos = [
                    "first_name" => $user->getFirst_name(),
                    "last_name" => $user->getLast_name(),
                    "email" => $user->getEmail()
                ];

                $currentChildInfos = [];

                // je crée un tabeleau de tableaux associatifs avec les infos des mioches

                foreach($children as $child){
                    $currentChildInfos[] = [
                        "name" => $child->getName(),
                        "birth_date" => $child->getBirth_date()->format('Y-m-d')
                    ];
                }

                // je récupère la valeur des inputs liés aux users
                $infoUserForm = [
                    "first_name" => $_POST['first-name'],
                    "last_name" => $_POST['last-name'],
                    "email" => $_POST['email']
                ];

                // pareil pour les enfants
                
                $infoChildForm = [];

                foreach($_POST['child-name'] as $key => $value){
                    $infoChildForm[] = [
                        "name" => $_POST['child-name'][$key],
                        "birth_date" => $_POST['child-birth'][$key]
                    ];
                }

                // j'initialise un tableau pour stocker les infos modifiées du user
                $newInfosUser = [];
                // pareil pour les mioches
                $newInfosChildren = [];

                //  je boucle sur le tableau currentUserInfos pour comparer ses valeurs et celles de infoUserForm
                foreach($currentUserInfos as $key => $value){
                    if($infoUserForm[$key] !== $currentUserInfos[$key]){
                        $newInfosUser[$key] = $infoUserForm[$key];
                    }
                }


                //  en gros c le meme principe que pour le user sauf un peu différent car là j'ai un tableau de tableaux associatifs

                for($i = 0; $i < count($currentChildInfos); $i++){
                    foreach($currentChildInfos[$i] as $key => $value){
                        if($currentChildInfos[$i][$key] !== $infoChildForm[$i][$key]){
                            $newInfosChildren[$i][$key] = $infoChildForm[$i][$key];
                        }
                    }
                }


                // je boucle pour envoyer au model les infos d'un enfant à la fois
                // condition pour que la requete s'effectue que s'il y a des nouvelles infos
                if(count($newInfosChildren) > 0){
                    for($i = 0; $i < count($newInfosChildren); $i++){
                        $modelChild->updateChild($newInfosChildren[$i], $children[$i]->getId_child());                    
                    }
                    header('Location: /dashboard/update-user?user-card=' . $user->getCard()); 
                    
                } else {
                    header('Location: /dashboard/update-user?user-card=' . $user->getCard()); 
                                       
                } 
                $newChild = [];
                // condition pour que la requete s'effectue que s'il y a des nouvelles infos
                if(count($newInfosUser) > 0){
                    $modelUser->updateUserInfos($newInfosUser, $_POST['id_user']);
                    header('Location: /dashboard/update-user?user-card=' . $user->getCard());              
                } else {
                    header('Location: /dashboard/update-user?user-card=' . $user->getCard());
                                       
                }
                
            } else {
                if(isset($_POST['new-child-name'])){
                    $user = $modelUser->getUserById($_POST['id_user']);
                    $newChild[] = [
                        "name" => $_POST['new-child-name'],
                        "birth" => $_POST['new-child-date']
                    ];
                    $years = $modelChild->yearDiff($newChild, $diff);
        
                    if($years !== null){
                        $modelChild->newChild($user->getId_user(), $newChild);
                        header('Location: /dashboard/update-user?user-card=' . $user->getCard());
                        exit();             
                    }
                }
            }
        } else {
            if(isset($_GET['user-card'])){
                $user = $modelUser->getUserByCard($_GET['user-card']);
                
                if($user){
                    $children = $modelChild->getChildByUser($user->getId_user());
                }
            }
            
            require_once('./View/dashboard_update_user.php');
        }
    }

    public function deleteUser(){
        $a = file_get_contents('php://input');
        $id_user = json_decode($a, true);

        $model = new ModelUser();
        $model->deleteUser($id_user);
        echo json_encode(['success' => true]);

    }
}