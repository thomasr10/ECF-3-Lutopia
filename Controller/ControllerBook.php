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

    
    public function displayBooks(){

        $a = file_get_contents('php://input');
        $data = json_decode($a, true);
        $result = [];
        $model = new ModelBook();

        foreach($data as $age){
            foreach($age as $childAge){
                $result[] = $model->getId_Age($childAge);
            }
        }

        $books = $model->getBooksHomepage($result);
        
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

    }





















































    public function createBook(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['isbn']) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['illustrator']) && !empty($_POST['editor']) && !empty($_POST['publication_date']) && !empty($_POST['edition_date']) && !empty($_POST['synopsis']) && !empty($_POST['category']) && !empty($_POST['age']) && !empty($_POST['type']) && !empty($_FILES['picture']) && !empty($_POST['copy']) && !empty($_POST['id_author']) && !empty($_POST['id_illustrator'])){
                var_dump($_POST);
                //change img.ext
                $fileName = str_replace([' ', 'é', 'è', 'à'], ['_', 'e', 'e', 'a'], strtolower($_POST['title']));
                $_FILES['picture']['name'] = $fileName;
                $img = $fileName . '.webp';
                
                if(move_uploaded_file($_FILES['picture']['tmp_name'], './uploads/' . $img)){
                    
                    $model = new ModelBook();
                    $id_book = $model->addNewBook($_POST['isbn'], $_POST['title'], $_POST['editor'], $img, $_POST['publication_date'], $_POST['edition_date'], $_POST['synopsis'], intval($_POST['type']), intval($_POST['age']));

                    $model->addBookAuthor(intval($_POST['id_author']), $id_book);
                    $model->addBookIllustrator($id_book, intval($_POST['id_illustrator']));
                    $model->addBookCategory(intval($_POST['category']), $id_book);
                    $status = 0;
                    for($i = 0; $i <= $_POST['copy']; $i++){
                        $model->addBookCopy($status, $id_book);
                    }
                    
                    header('Location: /dashboard');
                    exit();

                } else {
                    echo "Erreur lors du téléchargement du fichier";
                    require_once('./View/dashboard_create_book.php');
                }
            }
        } else {

            $model = new ModelBook();
            $categories = $model->getBookCategories();
            $ageRanges = $model->getBookAgeRanges();
            $types = $model->getBookTypes();
            require_once('./View/dashboard_create_book.php');
        }
    }
    
}