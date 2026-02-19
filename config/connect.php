<?php
class database{
    public function connection(){
        return new PDO("mysql:host=localhost;dbname=salon","root","");
    }
}
?>