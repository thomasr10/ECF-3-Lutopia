<?php 

class ControllerBook {
    public function home(){
        global $router;
        $model = new ModelBook();
        $datas = $model->drawHome();
        // var_dump($datas); debug
        require_once('./View/homepage.php');
    }

    public function zeroTwo(){
        global $router;
        $model = new ModelBook();
        $datas = $model->drawZeroTwo();
        $radioDatas = $model->radioBookType();
        $categoryDatas = $model->categorySelect();
        // var_dump($datas); debug
        require_once('./View/zeroTwo.php');
    }
}