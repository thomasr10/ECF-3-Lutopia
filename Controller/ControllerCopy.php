<?php

class ControllerCopy {
    public function deleteCopy(int $id){
        $model = new ModelCopy();
        $model->deleteCopyOnIdCopy($id);

        echo json_encode(['succes' => true]);
    }

    public function updateState(){
        $a = file_get_contents('php://input');
        // reçoit un objet stdClass car pas de paramètre 'true' dans json_decode
        $data = json_decode($a);


        $model = new ModelCopy();
        $model->updateStateOnIdCopy($data->id_copy, $data->state);

        echo json_encode(['success' => true]);
    }

    public function addCopies(){
        $a = file_get_contents('php://input');
        $data = json_decode($a);

        $model = new ModelCopy();

        for($i = 0; $i < $data->copy_number; $i++){
            $model->addCopies($data->id_book);
        }

        echo json_encode(['success' => true]);
    }
}