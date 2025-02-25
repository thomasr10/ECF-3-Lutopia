<?php 

class ControllerBook {
    public function home(){
        $model = new ModelBook();
        $datas = $model->drawHome();
        var_dump($datas);
        require_once('./View/homepage.php');
    }
}