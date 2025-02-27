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
}