<?php

class Illustrator {
    private $id_illustrator;
    private $first_name;
    private $last_name;


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


    public function getId_illustrator(){
        return $this->id_illustrator;
    }
    public function getFirst_name(){
        return $this->first_name;
    }
    public function getLast_name(){
        return $this->last_name;
    }


    public function setId_illustrator($id_illustrator){
        $this->id_illustrator = $id_illustrator;
    }
    public function setFirst_name($first_name){
        $this->first_name = $first_name;
    }
    public function setLast_name($last_name){
        $this->last_name = $last_name;
    }
}