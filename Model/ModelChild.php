<?php

class ModelChild extends Model {

    public function getChildByUser(int $id){
        $req = $this->getDb()->prepare("SELECT `id_child`, `id_user`, `name`,`birth_date`, `end_valid_date` FROM `child` WHERE `id_user` = :id_user");
        $req->bindParam('id_user', $id, PDO::PARAM_INT);
        $req->execute();

        $arrayObj = [];
        
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Child($data);
        }

        return $arrayObj;
    }

// CHECK IF AGE IS VALID 
    public function yearDiff(array $arrayChild, int $diff){
        $years = [];
        foreach($arrayChild as $child){
            // année de naissance de l'enfant
            $year1 = date('Y', strtotime($child['birth']));
            // année en cours
            $year2 = date('Y');

            // si un user a rentré une date dans le futur
            if($year1 > $year2){
                return false;
            } else {
                // sinon, check si l'enfant a -10ans
                $years[] = (abs($year1 - $year2) < $diff) ? abs($year1 - $year2) : null;
                                
            }
        }
        return $years;
    }

    public function newChild(int $id, array $arrayChild){
        $bdd = $this->getDb();
        $req = $bdd->prepare("INSERT INTO `child`(`id_user`, `name`, `birth_date`, `end_valid_date`) VALUES (:id, :name, :birth, :birth + INTERVAL 12 YEAR)");

        foreach($arrayChild as $child){
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->bindParam('name', $child['name'], PDO::PARAM_STR);
            $req->bindParam('birth', $child['birth'], PDO::PARAM_STR);
            $req->execute();
        }
    }

    public function newReservation(int $book, int $child){
        $req = $this->getDb()->prepare('INSERT INTO `reservation`(`reservation_date`, `id_child`, `id_book`) VALUES ( NOW(), :id_child, :id_book )');
        $req->bindParam('id_child', $child, PDO::PARAM_STR);
        $req->bindParam('id_book', $book, PDO::PARAM_STR);
        $req->execute();
    }

    public function maxReservation(int $child){
        $req = $this->getDb()->prepare("SELECT COUNT(*) AS 'max' FROM `reservation` WHERE `id_child` = :id_child");
        $req->bindParam('id_child', $child, PDO::PARAM_INT);
        $req->execute();
        $max = $req->fetch(PDO::FETCH_ASSOC);
        return $max;
    }

    public function alreadyReserved(int $book, int $child){
        $req = $this->getDb()->prepare("SELECT `id_reservation`, `reservation_date`, `id_child`, `id_book` FROM `reservation` WHERE `id_child` = :id_child AND `id_book` = :id_book;");
        $req->bindParam('id_child', $child, PDO::PARAM_INT);
        $req->bindParam('id_book', $book, PDO::PARAM_INT);
        $req->execute();
        $arrayObj = [];
        
        $already = $req->fetch(PDO::FETCH_ASSOC);
        return $already;
    }

    public function getReservationChild(int $child){
        $req = $this->getDb()->prepare("SELECT `reservation`.`id_reservation`, `reservation`.`reservation_date`, `reservation`.`id_child`, `reservation`.`id_book`, `book`.`title`, `book`.`publication_date`, `book`.`img_src` FROM `reservation` INNER JOIN `book` ON `reservation`.`id_book` =`book`.`id_book` WHERE `reservation`.`id_child` = :id_child;");
        $req->bindParam('id_child', $child, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new ReservationDTO(new Reservation($data), $data['img_src']);
        }
        return $arrayobj;
    }
}