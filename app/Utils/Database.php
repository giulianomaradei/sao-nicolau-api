<?php

class Database{

    private $conn = null;

    private static $instance = null;

    private function __construct(){
        $this->conn = $this->connect();
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private static function connect(){

        $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');

        $servername = $env['DB_HOST'];
        $username = $env['DB_USER'];
        $password = $env['DB_PASSWORD'];
        $dbname = $env['DB_NAME'];
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            return $conn;
        }
        
        return $conn;
    }


    public static function query($sql){
        $conn = self::getInstance()->conn;
        $result = $conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function prepare($sql){
        $conn = self::getInstance()->conn;
        return $conn->prepare($sql);
    }

    public static function getLastInsertedId(){
        $conn = self::getInstance()->conn;
        return $conn->insert_id;
    }

    public static function close($conn){
        $conn->close();
    }
}
?>
