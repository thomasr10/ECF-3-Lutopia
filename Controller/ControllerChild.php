<?php

class ControllerChild {

    public function registerChild(){
        global $router;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!empty($_POST['child-name']) && !empty($_POST['child-birth'])){

                $arrayChild = [];
                //associate child name with child birth
                for($i = 0; $i < count($_POST['child-name']); $i++){
                    $arrayChild[] = [
                        "name" => $_POST['child-name'][$i],
                        "birth" => $_POST['child-birth'][$i]
                    ];
                }
    
                $diff = 10;
                $model = new ModelChild();
                $years = $model->yearDiff($arrayChild, $diff);
                $id = $_SESSION['id'];

                if($years !== null){
                    $model->newChild($id, $arrayChild);                   
                    header('Location: /confirmation/' . $id);
                    exit();
                } else {
                    require_once('./View/register-child.php');
                }
            }
        } else {
            require_once('./View/register-child.php');
        }
    }

    public function home(){
        global $router;
        if(isset($_SESSION['id']) && $_SESSION['role'] == 0){
            
            $model = new ModelChild();
            $id = $_SESSION['id'];
            $datas = $model->getChildByUser($id);

            require_once('./View/homepage.php');
        } else {
            $model = new ModelBook();
            $books = $model->getBooksUnconnectHomepage();

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

            require_once('./View/homepage.php');
        }
        

    }

    public function reservationBook(int $book, int $child){
        global $router;
        $model = new ModelChild();
        header('Content-Type: application/json');
        $already = $model->alreadyReserved($book, $child);
        if($already == ''){
            $maxRes = $model->maxReservation($child);
            if($maxRes['max'] < 3){
                $reservation = $model->newReservation($book, $child); 
                echo json_encode("ok");
            } else {
                echo json_encode("max");
            }
        } else {
            echo json_encode("already");
        }
    }

    public function showReservation(int $child){
        global $router;
        $model = new ModelChild();
        $show = $model->getReservationChild($child);
        header('Content-Type: application/json');
        

        if($show){
            foreach($show as $i=>$reservation){
                $arrayObj[] = [
                    "id_reservation" => $show[$i]->reservation->getId_reservation(), 
                    "reservation_date" => $show[$i]->reservation->getResevation_date(), 
                    "id_child" => $show[$i]->reservation->getId_child(), 
                    "id_book" => $show[$i]->reservation->getId_book(), 
                    "title" => $show[$i]->reservation->getTitle(), 
                    "end_date" => $show[$i]->reservation->getEnd_date(), 
                    "img_src" => $show[$i]->img_src 
                ];
            }
            echo json_encode($arrayObj);
        } else {
            echo json_encode("Aucune réservation");
        }
    }

    public function removeReservation(int $reservation){
        global $router;
        $model = new ModelUser();
        $remove = $model->deleteReservation($reservation);
        header('Content-Type: application/json');
        if($remove){
            echo json_encode('ok');
        } else {
            echo json_encode('pas ok');
        }
        
    }


    public function deleteChild(){
        $a = file_get_contents('php://input');
        $id_child = json_decode($a, true);
        
        $model = new ModelChild();
        $model->deleteChild($id_child);

        $data = ["success" => true];

        echo json_encode($data);
    }
}