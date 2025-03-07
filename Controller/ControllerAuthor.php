<?php

class ControllerAuthor {

    public function searchAuthor(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);
        $model = new ModelAuthor();
        $author = $model->searchAuthor($data);


    }
}