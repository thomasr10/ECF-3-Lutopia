<?php

class ModelChild extends Model {

    public function getChildByUser(int $id){
        $req = $this->getDb()->prepare("SELECT `id_child`, `id_user`, `name`,`birth_date` FROM `child` WHERE `id_user` = :id_user");
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
        $years;
        foreach($arrayChild as $child){
            $year1 = date('Y', strtotime($child['birth']));
            $year2 = date('Y');

            if($year1 > $year2){
                return false;
            } else {
                $years = (abs($year1 - $year2) < $diff) ? abs($year1 - $year2) : null;
                return $years;                
            }
        }
    }

    public function newChild(int $id, array $arrayChild, int $years){
        $bdd = $this->getDb();
        $req = $bdd->prepare("INSERT INTO `child`(`id_user`, `name`, `birth_date`, `end_valid_date`) VALUES (:id, :name, :birth, :birth + INTERVAL (12 - :years) YEAR)");

        foreach($arrayChild as $child){
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->bindParam('name', $child['name'], PDO::PARAM_STR);
            $req->bindParam('birth', $child['birth'], PDO::PARAM_STR);
            $req->bindParam('years', $years, PDO::PARAM_INT);
            $req->execute();
        }
    }
}