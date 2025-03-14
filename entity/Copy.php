<?php

class Copy {

    private $id_copy;
    private $state;
    private $id_book;


    public function __construct(array $datas){
        $this->hydrate($datas);
    }

    public function hydrate(array $datas){
        foreach($datas as $key => $value){

            $method = "set" . ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function setId_copy($id_copy){
        $this->id_copy = $id_copy;
    }
    public function setState($state){
        $this->state = $state;
    }
    public function setId_book($id_book){
        $this->id_book = $id_book;
    }


    public function getId_copy(){
        return $this->id_copy;
    }
    public function getState(){
        return $this->state;
    }
    public function getId_book(){
        return $this->id_book;
    }


}