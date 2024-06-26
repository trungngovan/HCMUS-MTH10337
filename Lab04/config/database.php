<?php
class Database{

    // specify your own database credentials
    private $host = "127.0.0.1";
    private $db_name = "php_class";
    private $username = "root";
    private $password = "123456";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>