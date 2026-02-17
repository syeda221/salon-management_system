<?php
class db{
    public function connect(){
        return new PDO("mysql=host:localhost;dbname:salon","","root");
    }
}
?>