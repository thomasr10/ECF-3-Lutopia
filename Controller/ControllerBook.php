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

    public function zeroTwo(){
        global $router;
        $model = new ModelBook();
        $datas = $model->drawZeroTwo();
        $radioDatas = $model->radioBookType();
        $categoryDatas = $model->categorySelect();
        // var_dump($datas); debug
        require_once('./View/zeroTwo.php');
    }
}