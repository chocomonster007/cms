<?php

namespace App;
use App\Admin\User;

class Connection{

    private static $pdo;
    private static $settings = [];

    public function __construct(){
        self::$settings = require dirname(__DIR__).'/config/config.php';
    }
    
    public static function getPDO(){
        if(self::$settings == []){
            $set = new Connection();
        }
        
        if(is_null(self::$pdo)){
            self::$pdo = new \PDO("mysql:host=".self::$settings['host'].";dbname=".self::$settings['dbName'], self::$settings['username'], self::$settings['mdp']);
        }
        return self::$pdo;
    }
}