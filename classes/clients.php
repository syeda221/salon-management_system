<?php

class clients{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function all(){
    $q= $this->db->prepare("select * from clients ") ;
    $q->execute();
    return $q->fetchAll();
    }
}
?>