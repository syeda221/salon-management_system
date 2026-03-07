<?php
class users{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function allusers(){
        $q = $this->db->prepare("select * from users inner join roles on users.role_id = roles.id");
        $q->execute();
        return $q->fetchAll();
    }
 public function allrole(){
        $q = $this->db->prepare("select * from roles");
        $q->execute();
        return $q->fetchAll();
    }

public function addusers($role_id,$user_img,$user_name,$user_email,$user_password,$user_phone){

    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    $q = $this->db->prepare("
        INSERT INTO users(role_id,user_img,user_name,user_email,user_password,user_phone)
        VALUES(?,?,?,?,?,?)
    ");

    $q->execute([$role_id,$user_img,$user_name,$user_email,$user_password,$user_phone]);

    // get last inserted user id
    $user_id = $this->db->lastInsertId();

    // if role is STAFF (example role_id = 2)
    if($role_id == 3){

        $staffInsert = $this->db->prepare("
            INSERT INTO staff(user_id,name,staff_img)
            VALUES(?,?,?)
        ");

        $staffInsert->execute([
            $user_id,
            $user_name,
            $user_img
        ]);
    }

    return true;
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
      public function role(){
        $q = $this->db->prepare("select * from role");
        $q->execute();
        return $q->fetchAll();
    }
}
?>