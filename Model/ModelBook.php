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



































































    
    public function getBooksHomepage(array $array){

        $cleanArray = array_unique($array); // if more than 1 child for an id_age
        $doubleArray = array_merge($cleanArray, $cleanArray);
        $values = implode(',', array_fill(0, count($cleanArray), '?'));

        $req = $this->getDb()->prepare("WITH RankedBooks AS (SELECT `book`.`id_book`, `book`.`title`, `book`.`img_src`, `book`.`synopsis`, `book`.`id_type`, `age`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ', `illustrator`.`last_name`) AS 'illustrator', COUNT(`borrow`.`id_copy`) AS 'top', ROW_NUMBER() OVER (PARTITION BY `age`.`id_age` ORDER BY COUNT(`borrow`.`id_copy`) DESC) AS rn FROM `borrow` INNER JOIN `copy` ON `borrow`.`id_copy` = `copy`.`id_copy` INNER JOIN `book` ON `copy`.`id_book` = `book`.`id_book` INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `age`.`id_age` IN ($values) GROUP BY `book`.`id_book`, `age`.`id_age`, `author`, `illustrator`) SELECT `id_book`, `title`, `img_src`, `synopsis`, `id_type`, `id_age`, `author`, `illustrator`, `top` FROM RankedBooks WHERE rn <= 4 ORDER BY FIELD(`id_age`, $values), `top` DESC;");

        $req->execute($doubleArray);
        
    
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        
        $arrayObj = [];
        foreach ($data as $book) {
            $arrayObj[] = new BookDTO(new Book($book), $book['author'], $book['illustrator']);
        }
        return $arrayObj;
    }
    


}