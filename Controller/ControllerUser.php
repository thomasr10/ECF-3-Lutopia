<?php

class ControllerUser {
    
    public function register(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $model = new ModelUser();
            $user = $model->checkUser($_POST['name'], $_POST['email']);

            if($user){
                $message = "Adresse mail ou pseudo déjà existant";
            } else {
                if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confpassword'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[?.!+*-_&*]).{8,}$/";

                        if($_POST['password'] === $_POST['confpassword'] && preg_match($pattern, $_POST['password'])){
                            $hashed_pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
                            $token = bin2hex(random_bytes(50));
                            $lastId = $model->newUser($_POST['name'], $_POST['email'], $hashed_pass, $token);
                            $id = intval($lastId);

                            header('Location: /lutopia/confirmation/' . $id);
                            exit();

                        } else {
                            $message = "Mots de passe différents ou insuffisants";                       
                        }
                    } else {
                        $message = "Adresse mail invalide";
                    }
                } else {
                    $message = "Tous les champs doivent être remplis";
                }
            }

        } else {
            require_once('./View/register.php');
        }
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
            header('Location: /lutopia');
            exit();
        } else {
            require_once('./View/confirm-token.php');
            die('test');
        }
    }
}