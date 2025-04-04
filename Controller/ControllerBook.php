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

    public function drawAge(int $age, int $idchild = 0){

        global $router;
        $model = new ModelBook();
        if(isset($_SESSION['id'])){
            $modelchild = new ModelChild();
            $id = $_SESSION['id'];
            $datasChild = $modelchild->getChildByUser($id);
        }
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
                echo json_encode("Aucun livre trouvé pour ce type");
            }
    }

    public function showOneBook(int $id){
        global $router;

        $modelChild = new ModelChild();         //show reservation
        if(isset($_SESSION['id'])){
            $idSess = $_SESSION['id'];
            $datas = $modelChild->getChildByUser($idSess);
        }



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

                //change img.ext
                $fileName = str_replace([' ', '-', 'é', 'è', 'à'], ['_', '_', 'e', 'e', 'a'], strtolower($_POST['title']));
                $_FILES['picture']['name'] = $fileName;
                $img = $fileName . '.webp';
                $path = '/uploads' . '/' . $img;
                
                if(move_uploaded_file($_FILES['picture']['tmp_name'], './uploads/' . $img)){
                    $model = new ModelBook();
                    $id_book = $model->addNewBook($_POST['isbn'], $_POST['title'], $_POST['editor'], $path, $_POST['publication_date'], $_POST['edition_date'], $_POST['synopsis'], intval($_POST['type']), intval($_POST['age']));

                    $model->addBookAuthor(intval($_POST['id_author']), $id_book);
                    $model->addBookIllustrator($id_book, intval($_POST['id_illustrator']));
                    foreach($_POST['category'] as $category){
                        if($category !== ""){
                            $model->addBookCategory(intval($category), $id_book);
                        }
                    }
                    $status = 0;
                    for($i = 0; $i < $_POST['copy']; $i++){
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
            global $router;
            $model = new ModelBook();
            $categories = $model->getBookCategories();
            $ageRanges = $model->getBookAgeRanges();
            $types = $model->getBookTypes();
            require_once('./View/dashboard_create_book.php');
        }
    }


// livre dans la barre de recherche
    public function searchBook(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);

        $model = new ModelBook();
        $result = $model->searchBook($data);
        $arrayObj = [];

        foreach($result as $book){
            $arrayObj[] = [
                "id_book" => $book->book->getId_book(),
                "title" => $book->book->getTitle(),
                "author" => $book->author
            ];
        }
        echo json_encode($arrayObj);
    }

    public function modifyBook(){
        global $router;
        $model = new ModelBook();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['modify-book'])){
                if(!empty($_POST['isbn']) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['illustrator']) && !empty($_POST['editor']) && !empty($_POST['publication_date']) && !empty($_POST['edition_date']) && !empty($_POST['synopsis']) && !empty($_POST['id_book'])){
                    var_dump($_POST);
                    $model->modifyBook($_POST['isbn'], $_POST['title'], $_POST['author'], $_POST['illustrator'], $_POST['editor'], $_POST['publication_date'], $_POST['edition_date'], $_POST['synopsis'], $_POST['id_book']);
                    header('Location: /dashboard-book/modify-book?title=' . $_POST['title'] . '&id_book=' . $_POST['id_book']);
                }
                
            }
        } else {
            if(!empty($_GET['title']) && !empty($_GET['id_book'])){

                $id_book = intval($_GET['id_book']);
                // affichage du livre
                $book = $model->bookId($id_book);

                $copies = $model->getCopiesOnIdBook($id_book);
            }
            require_once('./View/dashboard_modify_book.php');
        }
    }

    public function checkCopies(){
        global $router;
        $model = new ModelBook();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        } else {
            if(!empty($_GET['title']) && !empty($_GET['id_book'])){

                $id_book = intval($_GET['id_book']);
                $copies = $model->getCopiesOnIdBook($id_book);
            }
            require_once('./View/dashboard_stock_book.php');
        }
    }


    public function getStatsBook(){
        global $router;
        $model = new ModelBook();

        if(isset($_GET['book'])){
            $book = $model->getBookOnSearch($_GET['book']);
        } else {
            
            $books = $model->getBestSellers();            
        }

        require_once('./View/dashboard_stat_book.php');
    }


    public function getStatsBookCountBorrowSortByAz(){
        $model = new ModelBook();
        $books = $model->getBookCountBorrowSortByZa();

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
                "from" => $books[$i]->age->getFrom(),
                "to" => $books[$i]->age->getTo(),
                "type_name" => $books[$i]->type->getType_name(),
                "author" => $books[$i]->author,
                "count_borrow" => $books[$i]->count_borrow,
            ];
        }

        echo json_encode($arrayObj);
    }


    public function getTopBookByYear(){
        $a = file_get_contents('php://input');
        $year = json_decode($a, true);

        $model = new ModelBook();
        $books = $model->getTopBookOnYear($year);

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
                "from" => $books[$i]->age->getFrom(),
                "to" => $books[$i]->age->getTo(),
                "type_name" => $books[$i]->type->getType_name(),
                "author" => $books[$i]->author,
                "count_borrow" => $books[$i]->count_borrow,
            ];
        }

        echo json_encode($arrayObj);
    }

    public function getTopBookByYearZa(){
        $a = file_get_contents('php://input');
        $year = json_decode($a, true);

        $model = new ModelBook();
        $books = $model->getTopBookByYearZa($year);

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
                "from" => $books[$i]->age->getFrom(),
                "to" => $books[$i]->age->getTo(),
                "type_name" => $books[$i]->type->getType_name(),
                "author" => $books[$i]->author,
                "count_borrow" => $books[$i]->count_borrow,
            ];
        }

        echo json_encode($arrayObj);
    }
}