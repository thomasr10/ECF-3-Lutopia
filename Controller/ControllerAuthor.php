<?php

class ControllerAuthor {

    public function searchAuthor(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);
        $model = new ModelAuthor();
        $authors = $model->searchAuthor($data);

        $arrayObj = []; 

        foreach($authors as $author){
            $arrayObj[] = [
                'id_author' => $author->getId_author(),
                'first_name' => $author->getFirst_name(),
                'last_name' => $author->getLast_name()
            ];
        }

        echo json_encode($arrayObj);

    }

    public function addAuthor(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);
        $model = new ModelAuthor();
        $model->addAuthor($data['first-name'], $data['last-name']);

        echo json_encode(["success" => true]);
    }
}