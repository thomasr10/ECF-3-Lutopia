<?php

class ControllerMail extends Mail {

    //mail de vérification du user
    public function sendMail($id){
        global $router;

        $url = $_SERVER['REQUEST_URI'];
        $s = explode('/', $url);
        $id = intval(end($s));
        $model = new ModelChild();
        $child = $model->getChildByUser($id);

        $phpmailer = $this->getPhpMailer();
        $model = new ModelUser();
        $user = $model->getNewUser($id);
        $email = $user->getEmail();
        $name = $user->getFirst_name();
        $token = $user->getToken();

        $phpmailer->setFrom('no-reply@lutopia.com', 'Lutopia');
        $phpmailer->addAddress($email, $name);

        $phpmailer->isHtml(true);
        $phpmailer->Subject = "Confirmation d'inscription";
        $phpmailer->addEmbeddedImage('C:\wamp64\www\Lutopia\uploads\email_logo_lutopia.png', 'logo_cid', 'email_logo_lutopia.png');
        
        $phpmailer->Body = "
            <html>
            <body style='font-family: Arial, sans-serif; background-color: #F7F7F7; color: #181B31; margin: 0; padding: 0;'>
                <h3 style='color: #653F31;'>Bonjour " . $name . ",</h3>
                <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>Bienvenue chez <span style='color: #FD9C94; font-weight: bold;'>Lutopia</span>, la première librairie uniquement dédiée aux enfants.</p>";
        
        if(count($child) > 1){
            $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>En espérant que vos petits </p>";
            $lastIndex = count($child) - 1;
            foreach($child as $index => $c){
                $phpmailer->Body .= "<span style='color: #181B31;'>" . $c->getName() . "</span>" . ($index < $lastIndex ? ', ' : ' ');
            }
            $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>trouvent leur bonheur parmi nos livres !</p>";
        } else {
            $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>En espérant que votre petit <span style='color: #FD9C94; font-weight: bold;'>" . $child[0]->getName() . "</span> trouve son bonheur parmi nos livres !</p>";
        }
        
        $phpmailer->Body .= "
                <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>Veuillez valider votre inscription en cliquant sur ce <a href='http://lutopia/confirm-user/" . $token . "' style='color: #FD9C94; font-weight: bold;'>lien</a></p>
                <br>
                <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>À bientôt sur <span style='color: #FD9C94; font-weight: bold;'>Lutopia</span> !</p>
                <div style='text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #181B31;'>
                    <img src='cid:logo_cid' alt='Logo Lutopia' style='display: block; margin: 20px; max-width: 100%;'>
                </div>
            </body>
            </html>
        ";
        
         
        $phpmailer->AltBody = "Inscription";
        $phpmailer->send();

        require_once('./view/confirmation.php');
    }









    



























    public function confirmRegisterFromDashboard(int $id){
        $url = $_SERVER['REQUEST_URI'];
        $s = explode('/', $url);
        $id = intval(end($s));
        $model = new ModelChild();
        $child = $model->getChildByUser($id);

        $phpmailer = $this->getPhpMailer();
        $model = new ModelUser();
        $user = $model->getNewUser($id);
        $email = $user->getEmail();
        $name = $user->getFirst_name();
        $token = $user->getToken();

        $phpmailer->setFrom('no-reply@lutopia.com', 'Lutopia');
        $phpmailer->addAddress($email, $name);

        $phpmailer->isHtml(true);
        $phpmailer->Subject = "Confirmation d'inscription";
        $phpmailer->addEmbeddedImage('C:\wamp64\www\Lutopia\uploads\email_logo_lutopia.png', 'logo_cid', 'email_logo_lutopia.png');
        
        $phpmailer->Body = "
        <html>
        <body style='font-family: Arial, sans-serif; background-color: #F7F7F7; color: #181B31; margin: 0; padding: 0;'>
            <h3 style='color: #653F31;'>Bonjour " . $name . ",</h3>
            <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>Bienvenue chez <span style='color: #FD9C94; font-weight: bold;'>Lutopia</span>, la première librairie uniquement dédiée aux enfants.</p>";
    
            if(count($child) > 1){
                $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>En espérant que vos petits </p>";
                $lastIndex = count($child) - 1;
                foreach($child as $index => $c){
                    $phpmailer->Body .= "<span style='color: #181B31;'>" . $c->getName() . "</span>" . ($index < $lastIndex ? ', ' : ' ');
                }
                $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>trouvent leur bonheur parmi nos livres !</p>";
            } else {
                $phpmailer->Body .= "<p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>En espérant que votre petit <span style='color: #FD9C94; font-weight: bold;'>" . $child[0]->getName() . "</span> trouve son bonheur parmi nos livres !</p>";
            }
            
            $phpmailer->Body .= "
                    <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>Veuillez valider votre inscription en cliquant sur ce <a href='http://lutopia/create-password/" . $id . "' style='color: #FD9C94; font-weight: bold;'>lien</a></p>
                    <br>
                    <p style='font-size: 16px; line-height: 1.5; margin: 10px 0; color: #181B31;'>À bientôt sur <span style='color: #FD9C94; font-weight: bold;'>Lutopia</span> !</p>
                    <div style='text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #181B31;'>
                        <img src='cid:logo_cid' alt='Logo Lutopia' style='display: block; margin: 20px; max-width: 100%;'>
                    </div>
                </body>
                </html>
            ";
    
        $phpmailer->send();

        require_once('./View/dashboard_validate_user.php');
    }

}

