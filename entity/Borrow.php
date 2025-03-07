<?php

class Borrow {
    private $card;
    private $last_name;
    private $name;
    private $start_date;
    private $end_date;
    private $id_borrow;
    private $id_copy;
    private $title;

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

    //getter
    public function getCard(){
        return $this->card;
    }
    public function getName(){
        return $this->name;
    }
    public function getLast_name(){
        return $this->last_name;
    }
    public function getStart_date(){
        return $this->start_date;
    }
    public function getEnd_date(){
        return $this->end_date;
    }
    public function getId_borrow(){
        return $this->id_borrow;
    }
    public function getId_copy(){
        return $this->id_copy;
    }
    public function getTitle(){
        return $this->title;
    }

    //setter
    public function setCard(string $card){
        $this->card = $card;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function setLast_name(string $last_name){
        $this->last_name = $last_name;
    }
    public function setStart_date(string $start_date){
        $this->start_date = new DateTime($start_date);
    }
    public function setEnd_date(string $end_date){
        $this->end_date = new DateTime($end_date);
    }
    public function setId_borrow(int $id_borrow){
        $this->id_borrow = $id_borrow;
    }
    public function setId_copy(int $id_copy){
        $this->id_copy = $id_copy;
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
}