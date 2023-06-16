<?php

namespace backend\core;

use PDO;

class Config{
    private static $config = [
        'mysql' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'php_mvc',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        ]
    ];

    public static function get($path = null){
        if($path){
            $config = self::$config;
            $path = explode('/', $path);

            foreach($path as $bit){
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}