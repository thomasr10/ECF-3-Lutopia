<?php

class Book {

    private $id_book;
    private $isbn;
    private $title;
    private $editor;
    private $img_src;
    private $publication_date;
    private $edition_date;
    private $synopsis;
    private $id_type;
    private $id_age;


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


//GETTERS
    public function getId_book(){
        return $this->id_book;
    }
    public function getIsbn(){
        return $this->isbn;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getEditor(){
        return $this->editor;
    }
    public function getImg_Src(){
        return $this->img_src;
    }
    public function getPublication_date(){
        return $this->publication_date;
    }
    public function getEdition_date(){
        return $this->edition_date;
    }
    public function getSynopsis(){
        return $this->synopsis;
    }
    public function getId_type(){
        return $this->id_type;
    }
    public function getId_age(){
        return $this->id_age;
    }


//SETTERS
    public function setId_book(int $id_book){
        $this->id_book = $id_book;
    }
    public function setIsbn(string $isbn){
        $this->isbn = $isbn;
    }
    public function setTitle(string $title){
        $this->title = $title;
    }
    public function setEditor(string $editor){
        $this->editor = $editor;
    }
    public function setImg_Src(string $img_src){
        $this->img_src = $img_src;
    }
    public function setPublication_date(string $publication_date){
        $this->publication_date = new DateTime($publication_date);
    }
    public function setEdition_date(string $edition_date){
        $this->edition_date = new DateTime($edition_date);
    }
    public function setSynopsis(string $synopsis){
        $this->synopsis = $synopsis;
    }
    public function setId_type(int $id_type){
        $this->id_type = $id_type;
    }
    public function setId_age(int $id_age){
        $this->id_age = $id_age;
    }
}