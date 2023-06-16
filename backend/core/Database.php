<?php

namespace backend\core;

use PDO;
use PDOException;

use backend\core\Config;

class Database{
    private static $instance = null;
    protected $lastInsertId = null;
    protected $db = null;

    private function __construct(){
        $host = Config::get('mysql/host');
        $username = Config::get('mysql/username');
        $password = Config::get('mysql/password');
        $database = Config::get('mysql/database');
        $options = Config::get('mysql/options');

        try{
            $this->db = new PDO("mysql:host=$host;dbname=$database", $username, $password, $options);
        }catch(PDOException $e){
            die('Connection failed: ' . $e->getMessage());
        }

        return $this->db;
    }

    public static function connect(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public static function query($sql, $params = []){
        $instance = self::connect();
        $stmt = $instance->db->prepare($sql);

        if(count($params)){
            $stmt->execute($params);
        }else{
            $stmt->execute();
        }

        return $stmt;
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }
}