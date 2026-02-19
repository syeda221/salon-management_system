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
    // public function logout()
    public function login($email,$password){
        $q = $this->db->prepare("SELECT * FROM users where user_email=?");
        $q->execute([$email]);
        $user = $q->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password,$user['user_password'])){
            return $user;
        }
        
            return false;
        
    }
}
?>