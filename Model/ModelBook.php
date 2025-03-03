<?php

class ModelBook extends Model {
    public function drawHome(){
        $req = $this->getDb()->query("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator`;");

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;
    }

    public function drawZeroTwo(){
        $req = $this->getDb()->query("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `book`.`id_age` = 1;");

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;
    }

    public function radioBookType(){
        $radioReq = $this->getDb()->query('SELECT `id_type`, `type_name` FROM `type`;');
        $radioArray = [];

        while($data = $radioReq->fetch(PDO::FETCH_ASSOC)){
            $radioArray[] = new Type($data);
        }
        return $radioArray;
    }
}