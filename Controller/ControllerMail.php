<?php

class ControllerMail extends Mail {

    public function sendMail($id){
        $url = $_SERVER['REQUEST_URI'];
        $s = explode('/', $url);
        $id = intval(end($s));

        $phpmailer = $this->getPhpMailer();
        $model = new ModelUser();
        $user = $model->getNewUser($id);
        $email = $user->getEmail();
        $name = $user->getName();
    }

}