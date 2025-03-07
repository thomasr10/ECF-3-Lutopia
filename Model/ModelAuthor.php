<?php

class ModelAuthor extends Model {

    public function searchAuthor(string $data){
        $search = '%' . $data . '%';
        $req = $this->getDb()->prepare("SELECT `id_author`, `first_name`, `last_name` FROM `author` WHERE `first_name` LIKE :search OR `last_name` LIKE :search");
        $req->bindParam('search', $search, PDO::PARAM_STR);
        $req->execute();

        $arrayObj = [];

        while($result = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Author($result);
        }
        var_dump($arrayObj);
    }
}