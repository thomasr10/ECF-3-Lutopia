<?php

class ModelBook extends Model {

    public function getId_age(int $age){
        $req = $this->getDb()->prepare("SELECT `id_age` FROM `age` WHERE :age >= `from` AND :age < `to`");
        $req->bindParam('age', $age, PDO::PARAM_INT);
        $req->execute();

        $id_age = $req->fetch(PDO::FETCH_COLUMN);
        return($id_age);
    }

    public function getBooksOnAge(int $id_age){
        $req = $this->getDb()->prepare("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `id_age`= :id_age ORDER BY `publication_date` LIMIT 8 ");
        $req->bindParam('id_age', $id_age, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;

    }

    public function getTypeBook(int $age, int $id_type, int $category){
        $req = $this->getDb()->prepare("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` INNER JOIN `book_category` ON `book`.`id_book` = `book_category`.`id_book` WHERE `book`.`id_age` = :id_age AND (((`book`.`id_type` = :id_type) OR (`book_category`.`id_category` = :id_category)) OR (`book`.`id_type` = :id_type AND `book_category`.`id_category` = :id_category)) ;");
        $req->bindParam('id_age', $age, PDO::PARAM_INT);
        $req->bindParam('id_type', $id_type, PDO::PARAM_INT);
        $req->bindParam('id_category', $category, PDO::PARAM_INT);
        $req->execute();
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

    public function categorySelect(){
        $categoryReq = $this->getDb()->query('SELECT `id_category`, `category_name` FROM `category`;');
        $categoryArray = [];

        while($data = $categoryReq->fetch(PDO::FETCH_ASSOC)){
            $categoryArray[] = new Category($data);
        }
        return $categoryArray;
    }


}