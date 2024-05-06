<?php
declare (strict_types = 1);
namespace MyApp;
class Database {
    private $conn;
    private $error;
    private static $instance;
    private $localhost = "localhost";
    private $username = "root";
    private $password = "Refaat";
    private $dbname = "ordersystem";
    public function __construct() {
        try {
            $this->conn = new \mysqli($this->localhost, $this->username, $this->password, $this->dbname);
            #echo "Connected Successfully";
        } catch (\Exception $e) {
            die("Connection Failed". $e->getMessage());
        }
         
    }
    /**
     * Singleton Design Pattern 
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function query(string $sql) {
        try {
            return $this->conn->query($sql);
        } catch (\Exception $e) {
            die("Query Failed". $e->getMessage());
        }
    }
    public function geterror(){
        return $this->error;
    }
    public function close() {
        $this->conn->close();
    }

    public function countRows($result) {
        return mysqli_num_rows($result);
    }

    public function fetchArray($result)
    {
    return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function prepare($sql) {
        return mysqli_prepare($this->conn, $sql);
    }

    public function bindParams($stmt, $types, ...$params) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    public function execute($stmt) {
        mysqli_stmt_execute($stmt);
    }
    
}