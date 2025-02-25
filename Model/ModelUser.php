<?php

class ModelUser extends Model{

    public function checkUser(string $name, string $email){
        $req = $this->getDb()->prepare("SELECT `name`, `email` FROM `user` WHERE `name` = :name OR `email` = :email");
        $req->bindParam('name', $name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function newUser(string $name, string $email, string $password){
        $req = $this->getDb()->prepare("INSERT INTO `user`(`user_name`, `email`, `password`, `role`, `status`, `token`, `signin_date`) VALUES (:name, :email, :password, 0, tok, NOW())");
        $req->bindParam('name', $name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->bindParam('password', $password, PDO::PARAM_STR);
        $req->execute();

        $lastId = $this->getDb()->lastInsertId();

        return $lastId;
    }

    public function getNewUser(int $id){
        $req =$this->getDb()->prepare("SELECT `id`, `name`, `email`, `password` FROM `user` WHERE `id` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }
}