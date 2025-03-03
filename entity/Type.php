<?php 

class Type{
    private $id_type;
    private $type_name;

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

    // getters
    public function getId_type(){
        return $this->id_type;
    }
    public function getType_name(){
        return $this->type_name;
    }

    //settters
    public function setId_type(int $id_type){
        $this->id_type = $id_type;
    }
    public function setType_name(string $type_name){
        $this->type_name = $type_name;
    }
}