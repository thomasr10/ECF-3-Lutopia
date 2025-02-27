<?php

class ControllerMail extends Mail {

    public function sendMail($id){
        global $router;

        $url = $_SERVER['REQUEST_URI'];
        $s = explode('/', $url);
        $id = intval(end($s));

        $phpmailer = $this->getPhpMailer();
        $model = new ModelUser();
        $user = $model->getNewUser($id);
        $email = $user->getEmail();
        $name = $user->getFirst_name();
        $token = $user->getToken();

        $phpmailer->setFrom('lutopia@gmail.com', 'Lutopia');
        $phpmailer->addAddress($email, $name);

        $phpmailer->isHtml(true);
        $phpmailer->Subject = "Confirmation d'inscription";
        $phpmailer->Body = "Bonjour " . $name . '.' . "Veuillez confirmez votre inscription en cliquant sur le <a href=" . "http://lutopia/confirm-user/" . $token . ">lien</a>";
        $phpmailer->AltBody = "Inscription";
        $phpmailer->send();

        require_once('./view/confirmation.php');
    }

}