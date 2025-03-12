<?php

class ControllerIllustrator {
    
    public function searchIllustrator(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);

        $model = new ModelIllustrator();
        $illustrators = $model->searchIllustrator($data);

        $arrayObj = [];
        
        foreach($illustrators as $illustrator){
            $arrayObj[] = [
                'id_illustrator' => $illustrator->getId_illustrator(),
                'first_name' => $illustrator->getFirst_name(),
                'last_name' => $illustrator->getLast_name()
            ];
        }

        echo json_encode($arrayObj);

    }


    public function addIllustrator(){
        $a = file_get_contents('php://input');
        $data = json_decode($a, true);
        $model = new ModelIllustrator();
        $model->addIllustrator($data['first-name'], $data['last-name']);

        echo json_encode(["succes" => true]);
    }
}