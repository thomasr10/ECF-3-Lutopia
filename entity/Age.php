<?php 

class Age {
    private $id_age;
    private $from;
    private $to;

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

    public function getId_age(){
        return $this->id_age;
    }
    public function getFrom(){
        return $this->from;
    }
    public function getTo(){
        return $this->to;
    }

    public function setId_age(int $id_age){
        $this->id_age = $id_age;
    }
    public function setFrom(int $from){
        $this->from = $from;
    }
    public function setTo(int $to){
        $this->to = $to;
    }
}