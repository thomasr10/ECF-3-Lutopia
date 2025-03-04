<?php

use PHPMailer\PHPMailer\PHPMailer;

abstract class Mail {

    private static $phpmailer;

    private static function setPhpmailer(){
        self::$phpmailer = new PHPMailer();
        self::$phpmailer->isSMTP();
        self::$phpmailer->CharSet = 'UTF-8';
        self::$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        self::$phpmailer->SMTPAuth = true;
        self::$phpmailer->Port = 2525;
        self::$phpmailer->Username = $_ENV['MAIL_USERNAME'];
        self::$phpmailer->Password = $_ENV['MAIL_PASSWORD'];    
    }

    // pattern de Singleton
    protected function getPhpmailer(){
        if(self::$phpmailer === null){
            self::setPhpmailer();
        }
        return self::$phpmailer;
    }
}