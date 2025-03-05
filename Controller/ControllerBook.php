<?php 

class ControllerBook {

    public function homePage(int $age){

        $model = new ModelBook();
        $id_age = $model->getId_age($age);

        header('Content-Type: application/json');

        if($id_age){
            $books = $model->getBooksOnAge($id_age);
            $arrayObj = [];

            foreach($books as $i => $book){
                $arrayObj[] = [
                    "id_book" => $books[$i]->book->getId_book(),
                    "isbn" => $books[$i]->book->getIsbn(),
                    "title" => $books[$i]->book->getTitle(),
                    "editor" => $books[$i]->book->getEditor(),
                    "img" => $books[$i]->book->getImg_src(),
                    "publication_date" => $books[$i]->book->getPublication_date(),
                    "edition_date" => $books[$i]->book->getEdition_date(),
                    "synopsis" => $books[$i]->book->getSynopsis(),
                    "id_type" => $books[$i]->book->getId_type(),
                    "id_age" => $books[$i]->book->getId_age(),
                    "author" => $books[$i]->author,
                    "illustrator" => $books[$i]->illustrator
                ]; 
            }
            echo json_encode($arrayObj);
               
        } else {
            echo json_encode("Aucun livre trouvé pour cet âge");
        }

        

    }

    public function drawAge(int $age){
        global $router;
        $model = new ModelBook();
        $datas = $model->drawAge($age);
        $ageInfos = $model->getAgeInfo($age);
        $radioDatas = $model->radioBookType();
        $categoryDatas = $model->categorySelect();
        // var_dump($datas); debug
        if(empty($datas)){
            header('Location: /error404');
        } else {
            require_once('./View/age.php');
        }
    }

    public function typeBook(int $age, int $type, int $category){

        // if($category == 0){
            $model = new ModelBook();
            $typeBook = $model->getTypeBook($age, $type, $category);

            header('Content-Type: application/json');

            if($typeBook){
                foreach($typeBook as $i => $book){
                    $arrayObj[] = [
                        "id_book" => $typeBook[$i]->book->getId_book(),
                        "isbn" => $typeBook[$i]->book->getIsbn(),
                        "title" => $typeBook[$i]->book->getTitle(),
                        "editor" => $typeBook[$i]->book->getEditor(),
                        "img" => $typeBook[$i]->book->getImg_src(),
                        "publication_date" => $typeBook[$i]->book->getPublication_date(),
                        "edition_date" => $typeBook[$i]->book->getEdition_date(),
                        "synopsis" => $typeBook[$i]->book->getSynopsis(),
                        "id_type" => $typeBook[$i]->book->getId_type(),
                        "id_age" => $typeBook[$i]->book->getId_age(),
                        "author" => $typeBook[$i]->author,
                        "illustrator" => $typeBook[$i]->illustrator
                    ]; 
                }
                echo json_encode($arrayObj);

            } else {
                echo json_encode("Aucun livre trouvé pour se type");
            }

        // }else {
            
        // }
    }

    public function showOneBook(int $id){
        global $router;
        $model = new ModelBook();
        $bookInfo = $model->bookId($id);
        if(empty($bookInfo)){
            header('Location: /error404');
        } else {
            require_once('./View/onebook.php');
        }
    }
}