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
    
                $diff = 12;
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
        if(isset($_SESSION['id'])){
            
            $model = new ModelChild();
            $id = $_SESSION['id'];
            $datas = $model->getChildByUser($id);

            require_once('./View/homepage.php');
        } else {
            require_once('./View/homepage.php');
        }
        

    }
}