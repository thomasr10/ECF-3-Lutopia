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
        $req = $this->getDb()->prepare("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `id_age`= :id_age ORDER BY `publication_date` LIMIT 8");
        $req->bindParam('id_age', $id_age, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;

    }

    public function getTypeBook(int $age, int $id_type, int $category){
        if($category == 0){
            $req = $this->getDb()->prepare("SELECT DISTINCT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` INNER JOIN `book_category` ON `book`.`id_book` = `book_category`.`id_book` WHERE `book`.`id_age` = :id_age AND `book`.`id_type` = :id_type ;");
            $req->bindParam('id_age', $age, PDO::PARAM_INT);
            $req->bindParam('id_type', $id_type, PDO::PARAM_INT);
        }
        if($id_type == 0){
            $req = $this->getDb()->prepare("SELECT DISTINCT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` INNER JOIN `book_category` ON `book`.`id_book` = `book_category`.`id_book` WHERE `book`.`id_age` = :id_age AND `book_category`.`id_category` = :id_category ;");
            $req->bindParam('id_age', $age, PDO::PARAM_INT);
            $req->bindParam('id_category', $category, PDO::PARAM_INT);
        }
        if($category == 0 && $id_type == 0){
            $req = $this->getDb()->prepare("SELECT DISTINCT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `book`.`id_age` = :id_age;");
            $req->bindParam('id_age', $age, PDO::PARAM_INT);
        }
        if($category != 0 && $id_type != 0){
            $req = $this->getDb()->prepare("SELECT DISTINCT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` INNER JOIN `book_category` ON `book`.`id_book` = `book_category`.`id_book` WHERE `book`.`id_age` = :id_age AND `book`.`id_type` = :id_type AND `book_category`.`id_category` = :id_category ;");
            $req->bindParam('id_age', $age, PDO::PARAM_INT);
            $req->bindParam('id_type', $id_type, PDO::PARAM_INT);
            $req->bindParam('id_category', $category, PDO::PARAM_INT);
        }
        
        
        $req->execute();
        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;
    }


    public function drawAge(int $id_age){
        $req = $this->getDb()->prepare("SELECT DISTINCT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `book`.`id_age` = :id_age;");
        $req->bindParam('id_age', $id_age, PDO::PARAM_INT);
        $req->execute();

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;
    }

    public function getAgeInfo(int $id_age){
        $req = $this->getDb()->prepare("SELECT `id_age`, `from`, `to` FROM `age` WHERE `id_age` = :id_age");
        $req->bindParam('id_age', $id_age, PDO::PARAM_INT);
        $req->execute();
        
        $ageArray = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $ageArray[] = new Age($data);
        }
        return $ageArray;
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

    public function bookId(int $id){
        $req = $this->getDb()->prepare("SELECT `book`.`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`, CONCAT(`author`.`first_name`, ' ' ,`author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ',`illustrator`.`last_name`) AS 'illustrator' FROM `book` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `book`.`id_book` = :id;");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();


        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayobj;
    }



































































    
    public function getBooksHomepage(array $array){

        $cleanArray = array_unique($array); // if more than 1 child for an id_age
        $doubleArray = array_merge($cleanArray, $cleanArray); // dédouble les valeurs car j'utilise 2x $values
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

    public function getBooksUnconnectHomepage(){
        $req = $this->getDb()->query("WITH RankedBooks AS (SELECT `book`.`id_book`, `book`.`title`, `book`.`img_src`, `book`.`synopsis`, `book`.`id_type`, `age`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ', `illustrator`.`last_name`) AS 'illustrator', COUNT(`borrow`.`id_copy`) AS 'top', ROW_NUMBER() OVER (PARTITION BY `age`.`id_age` ORDER BY COUNT(`borrow`.`id_copy`) DESC) AS rn FROM `borrow` INNER JOIN `copy` ON `borrow`.`id_copy` = `copy`.`id_copy` INNER JOIN `book` ON `copy`.`id_book` = `book`.`id_book` INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age` INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book` INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author` INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book` INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator` WHERE `age`.`id_age` IN (1, 2, 3, 4, 5) GROUP BY `book`.`id_book`, `age`.`id_age`, `author`, `illustrator`) SELECT `id_book`, `title`, `img_src`, `synopsis`, `id_type`, `id_age`, `author`, `illustrator`, `top` FROM RankedBooks WHERE rn <= 4 ORDER BY FIELD(`id_age`, 1, 2, 3, 4, 5), `top` DESC");

        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }
        return $arrayObj;

    }

    public function getBookCategories(){
        $req = $this->getDb()->query("SELECT `id_category`, `category_name` FROM `category`");
        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Category($data);
        }

        return $arrayObj;
    }


    public function getBookAgeRanges(){
        $req = $this->getDb()->query("SELECT `id_age`, `from`, `to` FROM `age`");
        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Age($data);
        }

        return $arrayObj;
    }
    
    public function getBookTypes(){
        $req = $this->getDb()->query("SELECT `id_type`, `type_name` FROM `type`");
        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Type($data);
        }

        return $arrayObj;
    }

    public function addNewBook(int $isbn, string $title, string $editor, string $img_src, string $publication_date, string $edition_date, string $synopsis, int $id_type, int $id_age){
        $req = $this->getDb()->prepare("INSERT INTO `book`(`isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`) VALUES (:isbn, :title, :editor, :img_src, :publication_date, :edition_date, :synopsis, :id_type, :id_age)");
        $req->bindParam('isbn', $isbn, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('editor', $editor, PDO::PARAM_STR);
        $req->bindParam('img_src', $img_src, PDO::PARAM_STR);
        $req->bindParam('publication_date', $publication_date, PDO::PARAM_STR);
        $req->bindParam('edition_date', $edition_date, PDO::PARAM_STR);
        $req->bindParam('synopsis', $synopsis, PDO::PARAM_STR);
        $req->bindParam('id_type', $id_type, PDO::PARAM_INT);
        $req->bindParam('id_age', $id_age, PDO::PARAM_INT);

        $req->execute();

        $id_book = $this->getDb()->lastInsertId();
        return $id_book;
    }


    public function addBookAuthor(int $id_author, int $id_book){
        $req = $this->getDb()->prepare("INSERT INTO `book_author`(`id_author`, `id_book`) VALUES (:id_author, :id_book)");
        $req->bindParam('id_author', $id_author, PDO::PARAM_INT);
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
    }

    public function addBookIllustrator(int $id_book, int $id_illustrator){
        $req = $this->getDb()->prepare("INSERT INTO `book_illustrator`(`id_book`, `id_illustrator`) VALUES (:id_book, :id_illustrator)");
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->bindParam('id_illustrator', $id_illustrator, PDO::PARAM_INT);
        $req->execute();
    }

    public function addBookCategory(int $id_category, int $id_book){
        $req = $this->getDb()->prepare("INSERT INTO `book_category`(`id_category`, `id_book`) VALUES (:id_category, :id_book)");
        $req->bindParam('id_category', $id_category, PDO::PARAM_INT);
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
    }

    public function addBookCopy(int $status, int $id_book){
        $req =$this->getDb()->prepare("INSERT INTO `copy`(`state`, `id_book`) VALUES (:status, :id_book)");
        $req->bindParam('status', $status, PDO::PARAM_INT);
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
    }


    public function searchBook(string $data){
        $search = $data . '%';
        $req = $this->getDb()->prepare("SELECT `book`.`id_book`, `book`.`title`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', CONCAT(`illustrator`.`first_name`, ' ', `illustrator`.`last_name`) AS 'illustrator' FROM `book` 
        INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book`
        INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author`
        INNER JOIN `book_illustrator` ON `book`.`id_book` = `book_illustrator`.`id_book`
        INNER JOIN `illustrator` ON `book_illustrator`.`id_illustrator` = `illustrator`.`id_illustrator`
        WHERE `book`.`title` LIKE :search
        OR `book`.`isbn` LIKE :search
        OR CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) LIKE :search;");
        $req->bindParam('search', $search, PDO::PARAM_STR);
        $req->execute();

        $arrayObj= [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new BookDTO(new Book($data), $data['author'], $data['illustrator']);
        }

        return $arrayObj;
    }



    public function getCopiesOnIdBook(int $id_book){
        $req = $this->getDb()->prepare("SELECT `id_copy`, `state`, `id_book` FROM `copy` WHERE `id_book` = :id_book");
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();

        $arrayObj = [];
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new Copy($data);
        }

        return $arrayObj;
    }



    public function modifyBook(int $isbn, string $title, string $author, string $illustrator, string $editor, string $publication_date, string $edition_date, string $synopsis, int $id_book){

        $req = $this->getDb()->prepare("UPDATE `book` SET `isbn`= :isbn,`title`= :title,`editor`= :editor, `publication_date`= :publication_date,`edition_date`= :edition_date,`synopsis`= :synopsis WHERE `id_book` = :id_book");

        $req->bindParam('isbn', $isbn, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('editor', $editor, PDO::PARAM_STR);
        $req->bindParam('publication_date', $publication_date, PDO::PARAM_STR);
        $req->bindParam('edition_date', $edition_date, PDO::PARAM_STR);
        $req->bindParam('synopsis', $synopsis, PDO::PARAM_STR);
        $req->bindParam('id_book', $id_book, PDO::PARAM_INT);
        $req->execute();
    }



    public function getBestSellers(){
        $req = $this->getDb()->query("SELECT COUNT(`borrow`.`id_copy`) AS 'count_borrow', `book`.`id_book`, `book`.`isbn`, `book`.`title`, `book`.`editor`, `book`.`img_src`, `book`.`publication_date`, `book`.`edition_date`, `book`.`synopsis`, `book`.`id_type`, `book`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', `age`.`from`, `age`.`to`, `type`.`type_name`
        FROM `book`
        INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book`
        INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author`
        INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age`
        INNER JOIN `copy` ON `book`.`id_book` = `copy`.`id_book`
        INNER JOIN `borrow` ON `copy`.`id_copy` = `borrow`.`id_copy`
        INNER JOIN `type` ON `book`.`id_type` = `type`.`id_type`
        GROUP BY `book`.`id_book`
        ORDER BY `count_borrow` DESC
        LIMIT 20");

        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new BookResa(new Book($data), new Age($data), new Type($data), $data['author'], $data['count_borrow']);
        }

        return $arrayObj;

    }

    public function getBookCountBorrowSortByZa(){
        $req = $this->getDb()->query("SELECT COUNT(DISTINCT `borrow`.`id_copy`) AS 'count_borrow', `book`.`id_book`, `book`.`isbn`, `book`.`title`, `book`.`editor`, `book`.`img_src`, `book`.`publication_date`, `book`.`edition_date`, `book`.`synopsis`, `book`.`id_type`, `book`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', `age`.`from`, `age`.`to`, `type`.`type_name`
        FROM `book`
        INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book`
        INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author`
        INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age`
        LEFT JOIN `copy` ON `book`.`id_book` = `copy`.`id_book`
        LEFT JOIN `borrow` ON `copy`.`id_copy` = `borrow`.`id_copy`
        INNER JOIN `type` ON `book`.`id_type` = `type`.`id_type`
        GROUP BY `book`.`id_book`
        ORDER BY count_borrow ASC
        LIMIT 20;");

        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new BookResa(new Book($data), new Age($data), new Type($data), $data['author'], $data['count_borrow']);
        }

        return $arrayObj;
    }


    public function getBookOnSearch(string $value){
        $search = $value . '%';
        $req = $this->getDb()->prepare("SELECT COUNT(`borrow`.`id_copy`) AS 'count_borrow', `book`.`id_book`, `book`.`isbn`, `book`.`title`, `book`.`editor`, `book`.`img_src`, `book`.`publication_date`, `book`.`edition_date`, `book`.`synopsis`, `book`.`id_type`, `book`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', `age`.`from`, `age`.`to`, `type`.`type_name`
        FROM `book`
        INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book`
        INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author`
        INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age`
        LEFT JOIN `copy` ON `book`.`id_book` = `copy`.`id_book`
        LEFT JOIN `borrow` ON `copy`.`id_copy` = `borrow`.`id_copy`
        INNER JOIN `type` ON `book`.`id_type` = `type`.`id_type`
        WHERE `book`.`title` LIKE :search
        OR `book`.`isbn` LIKE :search
        ;");
        $req->bindParam('search', $search, PDO::PARAM_STR);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        return ($data) ? new BookResa(new Book($data), new Age($data), new Type($data), $data['author'], $data['count_borrow']) : null;
    }



    public function getTopBookOnYear(string $year){
        
        $date1 = $year . '/01/01';
        $date2 = $year . '/12/31';

        $req = $this->getDb()->prepare("SELECT COUNT(DISTINCT `borrow`.`id_copy`) AS 'count_borrow', `book`.`id_book`, `book`.`isbn`, `book`.`title`, `book`.`editor`, `book`.`img_src`, `book`.`publication_date`, `book`.`edition_date`, `book`.`synopsis`, `book`.`id_type`, `book`.`id_age`, CONCAT(`author`.`first_name`, ' ', `author`.`last_name`) AS 'author', `age`.`from`, `age`.`to`, `type`.`type_name`
        FROM `book`
        INNER JOIN `book_author` ON `book`.`id_book` = `book_author`.`id_book`
        INNER JOIN `author` ON `book_author`.`id_author` = `author`.`id_author`
        INNER JOIN `age` ON `book`.`id_age` = `age`.`id_age`
        LEFT JOIN `copy` ON `book`.`id_book` = `copy`.`id_book`
        LEFT JOIN `borrow` ON `copy`.`id_copy` = `borrow`.`id_copy`
        INNER JOIN `type` ON `book`.`id_type` = `type`.`id_type`
        WHERE `borrow`.`start_date` >= :date1 AND `borrow`.`start_date` <= :date2
        GROUP BY `book`.`id_book`
        ORDER BY count_borrow ASC
        LIMIT 20");

        $req->bindParam('date1', $date1, PDO::PARAM_STR);
        $req->bindParam('date2', $date2, PDO::PARAM_STR);
        $req->execute();

        $arrayObj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayObj[] = new BookResa(new Book($data), new Age($data), new Type($data), $data['author'], $data['count_borrow']);
        }

        return $arrayObj;
    }
}