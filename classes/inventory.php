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
    public function add($productname,$quantity,$limit){
       $q =  $this->db->prepare("insert into inventory (`product_name`, `quantity`, `min_limit`) values(?,?,?)");
       $q->execute([$productname,$quantity,$limit]);
       return $q;
       
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