<?php
class database{
    public function connection(){
        return new PDO("mysqli=host:localhost;dbname:salon","root","");
    }
}
?>