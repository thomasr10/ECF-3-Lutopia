<?php

use PHPMailer\PHPMailer\PHPMailer;

abstract class Mail {

    private static $phpmailer;

    private static function setPhpmailer(){
        self::$phpmailer = new PHPMailer();
        self::$phpmailer->isSMTP();
        self::$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        self::$phpmailer->SMTPAuth = true;
        self::$phpmailer->Port = 2525;
        self::$phpmailer->Username = 'd311165f9141d2';
        self::$phpmailer->Password = '08b7bb0684f678';    
    }

    // pattern de Singleton
    protected function getPhpmailer(){
        if(self::$phpmailer === null){
            self::setPhpmailer();
        }
        return self::$phpmailer;
    }
}