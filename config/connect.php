<?php
class database{
    public function connection(){
        return new PDO("mysql:host=localhost;dbname=salam_management","root","");
    }
}
?>