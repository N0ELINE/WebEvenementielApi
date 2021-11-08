<?php

/**
 * Description of singletonConfig
 *
 * @author Nöeline
 */
class singletonConfig {
    
    private  $config = [];
    private static $instance;
    
    private function __construct() {
        

        $this->config = parse_ini_file("config.ini");
        
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new singletonConfig();
        }
        return self::$instance;
    }
    
    public function get($key){
        
        return $this->config[$key];
         
    }
    
}
