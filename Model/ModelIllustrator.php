<?php

class ModelIllustrator extends Model {
    
    public function searchIllustrator(string $data){
        $search = $data . '%';
        $req = $this->getDb()->prepare("SELECT `id_illustrator`, `first_name`, `last_name` FROM `illustrator` WHERE `first_name` LIKE :search OR `last_name` LIKE :search OR CONCAT(`first_name`, ' ', `last_name`) LIKE :search");
        $req->bindParam('search', $search, PDO::PARAM_STR);
        $req->execute();

        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Illustrator($data);
        }
        return $arrayObj;
    }

    public function addIllustrator(string $first_name, string $last_name){
        $req = $this->getDb()->prepare("INSERT INTO `illustrator`(`first_name`, `last_name`) VALUES (:first_name, :last_name)");
        $req->bindParam('first_name', $first_name, PDO::PARAM_STR);
        $req->bindParam('last_name', $last_name, PDO::PARAM_STR);
        $req->execute();
    }
}