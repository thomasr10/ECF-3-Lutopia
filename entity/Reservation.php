<?php

class Reservation {
    private $id_reservation;
    private $reservation_date;
    private $id_child;
    private $id_book;
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

    //getters

    public function getId_reservation(){
        return $this->id_reservation;
    }
    public function getResevation_date(){
        return $this->reservation_date;
    }
    public function getId_child(){
        return $this->id_child;
    }
    public function getId_book(){
        return $this->id_book;
    }
    public function getTitle(){
        return $this->title;
    }

    //setter

    public function setId_reservation(int $id_reservation){
        $this->id_reservation = $id_reservation;
    }
    public function setReservation_date(string $reservation_date){
        $this->reservation_date = new DateTime($reservation_date);
    }
    public function setId_child(int $id_child){
        $this->id_child = $id_child;
    }
    public function setId_book(int $id_book){
        $this->id_book = $id_book;
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
}