<?php

class ModelUser extends Model {

    public function checkUser(string $name, string $email){
        $req = $this->getDb()->prepare("SELECT `user_name`, `email` FROM `user` WHERE `user_name` = :name OR `email` = :email");
        $req->bindParam('name', $name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function newUser(string $name, string $email, string $password, string $token){
        $req = $this->getDb()->prepare("INSERT INTO `user`(`user_name`, `email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date`) VALUES (:name, :email, :password, 0, 0, :token, NOW() + INTERVAL 15 MINUTE ,NOW())");
        $req->bindParam('name', $name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->bindParam('password', $password, PDO::PARAM_STR);
        $req->bindParam('token', $token, PDO::PARAM_STR);
        $req->execute();

        $lastId = $this->getDb()->lastInsertId();

        return $lastId;
    }

    public function getNewUser(int $id){
        $req =$this->getDb()->prepare("SELECT `id_user`, `user_name`, `email`, `password`, `token` FROM `user` WHERE `id_user` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function checkUserByToken(string $token){
        $req = $this->getDb()->prepare("SELECT `id_user`, `user_name`, `email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date` FROM `user` WHERE `token` = :token AND `token_limit` > NOW()");
        $req->bindParam('token', $token, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function validateUser(string $email){
        $req = $this->getDb()->prepare("UPDATE `user` SET `status`= 1, `token`= null WHERE `email` = :email");
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();
    }
}