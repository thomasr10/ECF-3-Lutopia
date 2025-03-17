<?php

class ModelCopy extends Model {

    public function deleteCopyOnIdCopy(int $id){
        $req = $this->getDb()->prepare("DELETE FROM `copy` WHERE `id_copy` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}