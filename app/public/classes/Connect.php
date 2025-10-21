<?php

namespace classes;

use PDO;
use PDOException;

class Connect
{
    protected $host;
    protected $user;
    protected $password;
    protected $database;
    protected $port;
    protected $conn;
    public function __construct(string $host,string $user, string $password, string $database, int $port){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }
    public function connect(){
        $this->conn = null;
        try{
            $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
            $this->conn = new PDO($dsn, $this->user, $this->password);
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
    public function disconnect(){
        $this->conn = null;
    }
    public function query($sql, $params = []){
        try {
            $stmt = $this->conn->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value);
                }
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }

    }
    public function fetchOne($sql, $params = []){
        $stmt = $this->query($sql, $params);
        if($stmt){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function fetchAll($sql, $params = []){
        $stmt = $this->query($sql, $params);
        if($stmt){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function execute($sql, $params = []){
        $stmt = $this->query($sql, $params);
        if($stmt){
            return $stmt->rowCount();
        }
        return false;
    }
}