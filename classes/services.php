<?php
class services{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function allservice(){
        $q = $this->db->prepare("select * from services");
        $q->execute();
        return $q->fetch();
    }
      public function addservices($name,$img,$price){
        $q = $this->db->prepare("insert into services values(?,?,?,?)");
        $q->execute(null,$name,$img,$price);
        
    }
      public function delservices($id){
        $q = $this->db->prepare("DELETE FROM `services` WHERE id=?");
        $q->execute($id);
        
    }
        public function ediservices($id,$name,$img,$price){
        $q = $this->db->prepare("UPDATE `services` SET`service_name`=?,`services_img`=?,`price`=? WHERE  `id`=?");
        $q->execute($name,$img,$price,$id);
        
    }
}
?>