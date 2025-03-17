<?php

class ControllerCopy {
    public function deleteCopy(int $id){
        $model = new ModelCopy();
        $model->deleteCopyOnIdCopy($id);

        echo json_encode(['succes' => true]);
    }

    public function updateState(){
        $a = file_get_contents('php://input');
        // reçoit un objet stdClass
        $data = json_decode($a);


        $model = new ModelCopy();
        $model->updateStateOnIdCopy($data->id_copy, $data->state);

        echo json_encode(['success' => true]);
    }
}