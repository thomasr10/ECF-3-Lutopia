<?php

class ModelCopy extends Model {

    public function deleteCopyOnIdCopy(int $id){

        $req = $this->getDb()->prepare("DELETE FROM `copy` WHERE `id_copy` = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function  updateStateOnIdCopy(int $id_copy, int $state){

        $req =$this->getDb()->prepare("UPDATE `copy` SET `state`= :state WHERE `id_copy` = :id_copy");
        $req->bindParam('state', $state, PDO::PARAM_INT);
        $req->bindParam('id_copy', $id_copy, PDO::PARAM_INT);
        $req->execute();
    }


    public function addCopies(int $id_book){
        $req = $this->getDb()->prepare("INSERT INTO `copy`(`state`, `id_book`) VALUES (1, :id_book)");
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
    }
}