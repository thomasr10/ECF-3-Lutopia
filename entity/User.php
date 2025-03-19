<?php

class User {

    private $id_user;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $role;
    private $status;
    private $token;
    private $signing_date;
    private $card;

    
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
    public function getId_user(){
        return $this->id_user;
    }
    public function getFirst_name(){
        return $this->first_name;
    }
    public function getLast_name(){
        return $this->last_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRole(){
        return $this->role;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getToken(){
        return $this->token;
    }
    public function getSigning_date(){
        return $this->signing_date;
    }
    public function getCard(){
        return $this->card;
    }


// SETTERS
    public function setId_user(int $id_user){
        $this->id_user = $id_user;
    }
    public function setFirst_name(string $first_name){
        $this->first_name = $first_name;
    }
    public function setLast_name(string $last_name){
        $this->last_name = $last_name;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }
    public function setRole(int $role){
        $this->role = $role;
    }
    public function setStatus(int $status){
        $this->status = $status;
    }
    public function setToken(string $token){
        $this->token = $token;
    }
    public function setSigning_date(string $signing_date){
        $this->signing_date = new DateTime($signing_date);
    }
    public function setCard(string $card){
        $this->card = $card;
    }
}