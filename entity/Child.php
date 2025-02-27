<?php

class Child {

    private $id_child;
    private $id_user; //correspond au parent
    private $name;
    private $birth_date;

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

    public function getId_child(){
        return $this->id_child;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function getName(){
        return $this->name;
    }
    public function getBirth_date(){
        return $this->birth_date;
    }


    public function setId_child(int $id_child){
        $this->id_child = $id_child;
    }
    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function setBirth_date(string $birth_date){
        $this->birth_date = new DateTime($birth_date);
    }
}