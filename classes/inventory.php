<?php

class Inventory {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        return $this->db->query("SELECT * FROM inventory")
        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reduceStock($id,$qty){

        $q = $this->db->prepare("
            UPDATE inventory
            SET quantity = quantity - ?
            WHERE id = ?
        ");

        return $q->execute([$qty,$id]);
    }
}