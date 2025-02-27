<?php

class ControllerUser {
    
    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $model = new ModelUser();
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
                                $model->newChild($id, $arrayChild);
                                $_SESSION['id'] = $id;
                                $_SESSION['name'] = $_POST['first-name'];                        
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

    public function newMail(int $id){
        $model = new ModelUser;
        $token = bin2hex(random_bytes(50));
        $model->updateToken($id, $token);
        header('Location: /confirmation/' . $id);
        exit();
    }

    public function confirmUser(string $token){
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
            die('test');
        }
    }

}