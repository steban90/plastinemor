<?php

final class DBConector {

    private static $_instance;
    private $pdo;

    public static function getPdoInstance() {
        if(self::$_instance === null){
            self::$_instance = new DBConector();
        }
        return self::$_instance->getPDO();
    }        
    public function getPDO(){
        return $this->pdo;
    }
    private function __construct() {
        try {
            $this->pdo = new PDO(DSN, DSN_USER, DSN_PWD, array(PDO::ATTR_PERSISTENT => TRUE));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         
            $this->pdo->exec('set names utf8');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

}