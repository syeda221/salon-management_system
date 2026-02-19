<?php
class auth{
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function register($roleid,$name,$email,$password){
        $password  = password_hash($password,PASSWORD_DEFAULT);
        $q = $this->db->prepare("INSERT INTO `users`( `role_id`, `user_name`, `user_email`, `user_password`) VALUES (?,?,?,?)");
         $q->execute([$roleid,$name,$email,$password]); 
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>