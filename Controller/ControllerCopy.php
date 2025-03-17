<?php

class ControllerCopy {
    public function deleteCopy(int $id){
        $model = new ModelCopy();
        $model->deleteCopyOnIdCopy($id);

        echo json_encode(['succes' => true]);
    }
}