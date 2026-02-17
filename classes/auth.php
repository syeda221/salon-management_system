<?php
class auth{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function register($name,$email,$password){
        $q = $this->db->prepare(["INSERT INTO `users`( `role_id`, `user_name`, `user_email`, `user_password`) VALUES (?,?,?,?)"]);
        $q->execute([2,$name,$email,$password]); 
    }
}
?>