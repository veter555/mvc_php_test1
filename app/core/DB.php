<?php

class DB {
    private $dbh;

    function __construct() {
        $instance = dbSingleton::getInstance();
        $this->dbh = $instance->getConnection();
    }

    public function getConnection() {
        return $this->dbh;
    }
    
    public function query($sql, $parameters = []) {
        $dbh = $this->getConnection();
        
        // prepare SQL statement
        $stmt = $dbh->prepare($sql);
        
        if ($stmt === false)
        {
            // trigger (big, orange) error
            trigger_error($dbh->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $result = $stmt->execute($parameters);

        // return result set's rows, if any
        if ($result !== false)
        {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }

    }
   
}