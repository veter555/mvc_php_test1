<?php

class dbSingleton {
    private static $instance = null;
    private $dbh;
    
    
    function __construct() {
        $dsn = 'mysql:host='. MYSQL_HOST .';port='. MYSQL_PORT .';dbname='. DB_NAME . ';charset=utf8';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );
        try {
            $this->dbh = new PDO($dsn, DB_USERNAME , DB_PASSWORD, $options);
          
        } catch (PDOException $e) {
           echo "Connection failed: ".$e->getMessage();
        } 

    }
    
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new dbSingleton();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->dbh;
    }
    
}