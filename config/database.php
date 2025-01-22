<?php
class Database{
    private $host = "localhost";
    private $db_name = "personalBlog";
    private $username = "root";
    private $password = "admin";

    public function connection(){
        try{
            $con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }
}