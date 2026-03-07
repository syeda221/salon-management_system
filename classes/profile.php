<?php
class profile{
    private $db;
    public function __construct($db){
        $this->db=$db;
    }
    public function profAll($id){
        $q=$this->db->prepare("Select * from users where id= ? ");
        $q->execute([$id]);
        return $q->fetch();
    }
}

?>