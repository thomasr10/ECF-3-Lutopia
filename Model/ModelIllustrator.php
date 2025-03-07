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
}