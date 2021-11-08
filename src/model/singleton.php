<?php
require_once('singletonConfig.php');
class Singleton  {
    private static $instance;
    private $config;
    
    public $cnx;
    private  $dsn ;
    private  $username;
    private  $password ;
    
    private function __construct() {
        $this->config = singletonConfig::getInstance();
        
        $this->dsn = $this->config->get('dsn');
        $this->username = $this->config->get('username');
        $this->password = $this->config->get('password');
        
        $this->cnx = new PDO($this->dsn, $this->username, $this->password);
    }

    public static function getInstance(): Singleton {
        if (is_null(self::$instance)) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
    
}