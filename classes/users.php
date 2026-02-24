<?php
class users{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function allusers(){
        $q = $this->db->prepare("select * from users");
        $q->execute();
        return $q->fetchAll();
    }
      public function addusers($name,$img,$price){
        $q = $this->db->prepare("insert into services (service_name,services_img,price) values(?,?,?)");
        $q->execute([$name,$img,$price]);
        
    }
      public function delservice($id){
        $q = $this->db->prepare("DELETE FROM `services` WHERE id=?");
        $q->execute($id);
        
    }
    
     public function ediid($id){
        $q = $this->db->prepare("SELECT * FROM `services` WHERE id=?");
        $q->execute([$id]);
       return $q->fetch();
        
    }
    public function ediservice($id,$name,$img,$price){
        $q = $this->db->prepare("UPDATE `services` SET `service_name`=?,`services_img`=?,`price`=? WHERE  `id`=?");
        $q->execute([$name,$img,$price,$id]);
        
    }
}
?>