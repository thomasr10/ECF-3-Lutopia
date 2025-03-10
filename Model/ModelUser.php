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

    public function updateUser(string $card, int $id){
        $req = $this->getDb()->prepare("UPDATE `user` SET `card`= :cards WHERE `id_user` = :id;");
        $req->bindParam(':cards', $card, PDO::PARAM_STR);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
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

    public function checkAdmin(string $name, string $email){
        $req = $this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`, `email`, `password`, `role`, `status` FROM `user` WHERE `first_name` = :fname AND `email` = :email");
        $req->bindParam('fname', $name, PDO::PARAM_STR);
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

    public function getReservationByCard(string $card){
        $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` WHERE `user`.`card` = :card;");
        $req->bindParam('card', $card, PDO::PARAM_STR);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Reservation($data);
        }
        return $arrayobj;
    }

    public function getBorrowByCard(string $card){
        $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`card` = :card;"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--
        $req->bindParam('card', $card, PDO::PARAM_STR);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Borrow($data);
        }
        return $arrayobj;
    }

    public function updateBorrow(int $id_borrow, string $end_date){
        $req = $this->getDb()->prepare("UPDATE `borrow` SET `end_date`= :end_date WHERE `id_borrow` = :id_borrow;");
        $req->bindParam('id_borrow', $id_borrow, PDO::PARAM_INT);
        $req->bindParam('end_date', $end_date, PDO::PARAM_STR);
        $req->execute();
    }

    public function deleteBorrow(int $id_borrow, string $end_date){
        $req = $this->getDb()->prepare("UPDATE `borrow` SET `end_date`= :end_date , `status` = 1 WHERE `id_borrow` = :id_borrow;");
        $req->bindParam('id_borrow', $id_borrow, PDO::PARAM_INT);
        $req->bindParam('end_date', $end_date, PDO::PARAM_STR);
        $req->execute();
    }
}