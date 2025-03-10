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
                                
                                //check child age  
                                $modelChild = new ModelChild();
                                $diff = 10;
                                $years = $modelChild->yearDiff($arrayChild, $diff);

                                //Pour récup les infos de la session si pb à l'inscription d'un enfant
                                $_SESSION['id'] = $id;
                                $_SESSION['first-name'] = $_POST['first-name']; 
                                $_SESSION['last-name'] = $_POST['name'];
                                $_SESSION['full-name'] = $_POST['first-name'] . ' ' . $_POST['name'];  
                                
                                if($years !== null){
                                    $modelChild->newChild($id, $arrayChild);                   
                                    header('Location: /confirmation/' . $id);
                                    exit();

                                } else {
                                   header('Location: /register-child');
                                }
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
                $search = $model->getBorrowByCard($_GET['searchAdminUser']);
                $reservation = $model->getReservationByCard($_GET['searchAdminUser']);
                
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prolong'])){
                $model = new ModelUser();
                $search2 = $model->updateBorrow($_POST['id_borrow'], $_POST['date_back']);
                $search = $model->getBorrowByCard($_GET['searchAdminUser']);
            }
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suppr'])){
                $model = new ModelUser();
                $search2 = $model->deleteBorrow($_POST['id_borrow'], $_POST['date_back']);
                $search = $model->getBorrowByCard($_GET['searchAdminUser']);
            }
            require_once('./View/dashboard.php');
        } else {
            header('Location: /');
        }
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
}