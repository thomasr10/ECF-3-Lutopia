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

    public function getUserById(int $id){

        $req =$this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`,`email`, `password`, `token`, `card` FROM `user` WHERE `id_user` = :id");
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

    public function getChildByCard(string $card){

        $req = $this->getDb()->prepare("SELECT `child`.`id_child`, `child`.`id_user`, `child`.`name`, `child`.`birth_date` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` WHERE `user`.`card` = :card;");
        $req->bindParam(':card', $card, PDO::PARAM_STR);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Child($data);
        }
        return $arrayobj;
    }

    public function getReservationByCard(string $card, string $child){

        $req = $this->getDb()->prepare(
        "SELECT `reservation`.`id_reservation`, 
        `reservation`.`reservation_date`, 
        `reservation`.`id_child`, 
        `reservation`.`id_book`, 
        `book`.`title` 
        FROM `user` 
        INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` 
        INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` 
        INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` 
        WHERE `user`.`card` = :card AND `child`.`id_child` = :child;");

        $req->bindParam('card', $card, PDO::PARAM_STR);
        $req->bindParam('child', $child, PDO::PARAM_STR);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Reservation($data);
        }
        return $arrayobj;
    }

    public function deleteReservation(int $id_reservation){
        $req = $this->getDb()->prepare("DELETE FROM `reservation` WHERE `id_reservation` = :id_reservation;");
        $req->bindParam('id_reservation', $id_reservation, PDO::PARAM_STR);
        $req->execute();
    }

    public function getAvailability(int $book){
        $req = $this->getDb()->prepare("SELECT `id_copy`, `state`, `id_book` FROM `copy` WHERE `id_book` = :book;");
        $req->bindParam('book', $book, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Copy($data);
        }
        return $arrayobj;

    }

    public function getBorrowCopy(int $copy){
        $req = $this->getDb()->prepare("SELECT `id_borrow`, `start_date`, `end_date`, `id_child`, `id_copy`, `status` FROM `borrow` WHERE `id_copy` = :copy AND `status` = 0;");
        $req->bindParam('copy', $copy, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Borrow($data);
        }
        return $arrayobj;
    }

    public function reservationToBorrow(int $id_reservation){
        $req = $this->getDb()->prepare(
        "SELECT `reservation`.`id_reservation`,
        `reservation`.`reservation_date`, 
        `reservation`.`id_child`, 
        `reservation`.`id_book`,        
        `copy`.`id_copy` 
        FROM `reservation` 
        INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` 
        INNER JOIN `copy` ON `book`.`id_book` = `copy`.`id_book` 
        INNER JOIN `borrow` ON `copy`.`id_copy` = `borrow`.`id_copy`
        WHERE `id_reservation` = :id AND `borrow`.`status` = 1 AND `borrow`.`end_date` < NOW() LIMIT 1;");  

        $req->bindParam('id', $id_reservation, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new ReservationDTO2(new Reservation($data), $data['id_copy']);
        }
        return $arrayobj;
    }

    public function createBorrow(int $id_child, int $id_copy){
        $req = $this->getDb()->prepare("INSERT INTO `borrow`(`start_date`, `end_date`, `id_child`, `id_copy`, `status`) VALUES (NOW(), NOW() + INTERVAL 15 DAY, :child , :copy , 0);");
        $req->bindParam('child', $id_child, PDO::PARAM_INT);
        $req->bindParam('copy', $id_copy, PDO::PARAM_INT);
        $req->execute();
    }

    public function getBorrowByCard(string $card,  string $child){
        $req = $this->getDb()->prepare(
        "SELECT `user`.`card`,
        `user`.`last_name`, 
        `child`.`name`, 
        `borrow`.`start_date`, 
        `borrow`.`end_date`, 
        `borrow`.`id_borrow`,
        `copy`.`id_copy`, 
        `book`.`title` 
        FROM `user` 
        INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` 
        INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` 
        INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` 
        INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` 
        WHERE `user`.`card` = :card AND `child`.`id_child` =:child AND `borrow`.`status` = '0';"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--

        $req->bindParam('card', $card, PDO::PARAM_STR);
        $req->bindParam('child', $child, PDO::PARAM_STR);
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

    public function getBorrowByUser(int $id, int $filter){
        if($filter == 0){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '0';"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--
        }
        if($filter == 1){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '0' ORDER BY `borrow`.`end_date` DESC;"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--
        }
        if($filter == 2){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '0' ORDER BY `borrow`.`start_date` DESC;"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--
        }
        if($filter == 3){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '0' ORDER BY `book`.`title` ASC;"); //AND `borrow`.`status` = '0' A AJOUTER AVEC LA BDD <--
        }
        
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Borrow($data);
        }
        return $arrayobj;
    }
    public function getBorrowByUserHistory(int $id, int $filter){
        if($filter == 0){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '1';"); 
        }
        if($filter == 1){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '1' ORDER BY `borrow`.`end_date` DESC;"); 
        }
        if($filter == 2){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '1' ORDER BY `borrow`.`start_date` DESC;"); 
        }
        if($filter == 3){
            $req = $this->getDb()->prepare("SELECT `user`.`card`,`user`.`last_name`, `child`.`name`, `borrow`.`start_date`, `borrow`.`end_date`, `borrow`.`id_borrow` ,`copy`.`id_copy`, `book`.`title` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `borrow` ON `child`.`id_child` = `borrow`.`id_child` INNER JOIN `copy` ON `copy`.`id_copy` = `borrow`.`id_copy` INNER JOIN `book` ON `book`.`id_book` = `copy`.`id_book` WHERE `user`.`id_user` = :id AND `borrow`.`status` = '1' ORDER BY `book`.`title` ASC;");
        }
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Borrow($data);
        }
        return $arrayobj;
    }

    public function getReservationByUser(int $id, int $filter){
        if($filter == 0){
            $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title`, `child`.`name` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` WHERE `user`.`id_user` = :id;");
        }
        if($filter == 1){
            $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title`, `child`.`name` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` WHERE `user`.`id_user` = :id;");
        }
        if($filter == 2){
            $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title`, `child`.`name` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` WHERE `user`.`id_user` = :id ORDER BY `reservation`.`reservation_date` DESC;");
        }
        if($filter == 3){
            $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title`, `child`.`name` FROM `user` INNER JOIN `child` ON `user`.`id_user` = `child`.`id_user` INNER JOIN `reservation` ON `child`.`id_child` = `reservation`.`id_child` INNER JOIN `book` ON `reservation`.`id_book` = `book`.`id_book` WHERE `user`.`id_user` = :id; ORDER BY `book`.`title` ASC");
        }
        
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new ReservationDTE(new Reservation($data), $data['name']);
        }
        return $arrayobj;
    }

    public function getInfoChildByUser(int $id){
        $req = $this->getDb()->prepare("SELECT `id_child`, `id_user`, `name`, `birth_date` FROM `child` WHERE `id_user` = :id;");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Child($data);
        }
        return $arrayobj;
    }



    //parameter
    public function updateInfo(int $id, string $firstname, string $lastname, string $email){
        $req = $this->getDb()->prepare("UPDATE `user` SET `first_name`= :firstname ,`last_name`= :lastname,`email`= :email WHERE `id_user` = :id_user");
        $req->bindParam('firstname', $firstname, PDO::PARAM_STR);
        $req->bindParam('lastname', $lastname, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->bindParam('id_user', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function getPasswordUser(int $id){
        $req = $this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date` FROM `user` WHERE `id_user` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data) ? new User($data) : null;
    }

    public function updatePassword(string $pass, int $id){
        $req = $this->getDb()->prepare("UPDATE `user` SET `password`=:pass WHERE `id_user` = :id;");
        $req->bindParam('pass', $pass, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    
    public function addUserFromDashboard(string $first_name, string $last_name, string $email){
        $req = $this->getDb()->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `role`, `status`, `token`, `token_limit`, `signin_date`, `card`) VALUES (:first_name, :last_name, :email, 0, 0, '', '', NOW(), '')");
        $req->bindParam('first_name', $first_name, PDO::PARAM_STR);
        $req->bindParam('last_name', $last_name, PDO::PARAM_STR);
        $req->bindParam('email', $email, PDO::PARAM_STR);
        $req->execute();

        $id = $this->getDb()->lastInsertId();
        return $id;
    }


    public function createPassword(string $password, int $id){
        $req = $this->getDb()->prepare("UPDATE `user` SET `password`=:pass, `status`=1 WHERE `id_user` = :id");
        $req->bindParam('pass', $password, PDO::PARAM_STR);
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function getUserByCard(string $search){
        $req = $this->getDb()->prepare("SELECT `id_user`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date`, `card` FROM `user` WHERE `card` = :search");
        $req->bindParam('search', $search, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $user = ($data) ?  new User($data) : null;
    }

    public function updateUserInfos(array $newInfos, int $id_user){
        // j'initialise des tableaux vides
        $fields = [];
        $clearValue = [];
        $realValue = [];

        //  je boucle sur le tableau des infos pour stocker des '?' dans $clearValue, les clés dans $fields et les valeurs dans $realValue
        foreach($newInfos as $key => $value){

            $fields[] = $key;
            $clearValue[] = '?';
            $realValue[] = $value;
            
        }

        // je rajoute l'id dans le tableau car on peut envoyer qu'un param dans un execute 
        array_push($realValue, $id_user);

        // je crée le début de la requête
        $query = "UPDATE `user` SET ";
        // pour connaitre le dernier index
        $numberOfIndex = count($newInfos) -1;

        // je boucle sur le tableau pour concaténer les champs + les clearValue
        for($i = 0; $i < count($fields); $i++){
            if($i === $numberOfIndex){
                $query .= $fields[$i] . '=' . $clearValue[$i];
            } else {
                $query .= $fields[$i] . '=' . $clearValue[$i] . ', ';
            }
        }

        //  je rajoute la clause where
        $query .= " WHERE `id_user` = ?";
        $req = $this->getDb()->prepare($query);        
        $req->execute($realValue);
    }


    public function deleteUser(int $id_user){
        $req = $this->getDb()->prepare("DELETE FROM `user` WHERE `id_user`= :id_user");
        $req->bindParam('id_user', $id_user, PDO::PARAM_INT);
        $req->execute();
    }
}