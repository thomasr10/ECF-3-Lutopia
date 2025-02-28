<?php

class ModelUser extends Model {

    public function checkUser(string $email){
        $req = $this->getDb()->prepare("SELECT `email` FROM `user` WHERE `email` = :email");
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function newUser(string $first_name, string $name, string $email, string $password, string $token){
        $req = $this->getDb()->prepare("INSERT INTO `user`(`first_name`, `last_name`,`email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date`) VALUES (:first_name ,:name, :email, :password, 0, 0, :token, NOW() + INTERVAL 15 MINUTE ,NOW())");
        $req->bindParam('first_name', $first_name, PDO::PARAM_STR);
        $req->bindParam('name', $name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->bindParam('password', $password, PDO::PARAM_STR);
        $req->bindParam('token', $token, PDO::PARAM_STR);
        $req->execute();

        $lastId = $this->getDb()->lastInsertId();

        return $lastId;
    }

    public function getNewUser(int $id){
        $req =$this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`,`email`, `password`, `token` FROM `user` WHERE `id_user` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function checkUserByToken(string $token){
        $req = $this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`,`email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date` FROM `user` WHERE `token` = :token AND `token_limit` > NOW()");
        $req->bindParam('token', $token, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function updateToken(int $id, string $token){
        $req = $this->getDb()->prepare("UPDATE `user` SET `token`= :token,`token_limit`= NOW() + INTERVAL 15 MINUTE WHERE `id_user` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->bindParam('token', $token, PDO::PARAM_STR);
        $req->execute();
    }

    public function validateUser(string $email){
        $req = $this->getDb()->prepare("UPDATE `user` SET `status`= 1, `token`= null WHERE `email` = :email");
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();
    }

    public function checkUserByEmail(string $email){
        $req = $this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`, `email`, `password`, `role`, `status` FROM `user` WHERE `email` = :email");
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function isConnected(){
        if(isset($_SESSION['id'])){
            header('Location: /');
        }
    }
}