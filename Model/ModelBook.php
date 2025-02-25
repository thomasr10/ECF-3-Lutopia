<?php

class ModelBook extends Model {
    public function drawHome(){
        $req = $this->getDb()->query('SELECT `id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age` FROM `book`');

        $arrayobj = [];

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $arrayobj[] = new Book($data);
        }
        return $arrayobj;
    }
}