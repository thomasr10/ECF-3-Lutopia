<?php 

class ControllerBook {
    public function home(){
        global $router;
        $model = new ModelBook();
        $datas = $model->drawHome();
        // var_dump($datas); debug
        require_once('./View/homepage.php');
    }
}