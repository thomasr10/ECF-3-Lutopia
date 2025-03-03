<?php 

class Category{
    private $id_category;
    private $category_name;

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
    public function getId_category(){
        return $this->id_category;
    }
    public function getCategory_name(){
        return $this->category_name;
    }

    //settters
    public function setId_category(int $id_category){
        $this->id_category = $id_category;
    }
    public function setCategory_name(string $category_name){
        $this->category_name = $category_name;
    }
}