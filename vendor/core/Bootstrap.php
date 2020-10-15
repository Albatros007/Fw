<?php

namespace vendor\core;

/**
 * Description of Bootstrap
 *
 * @author Sirius7
 */
class Bootstrap 
{
    use SingletoneTrait;
    
    public static $objs = [];
    
    private function __construct() 
    {
        $components = require_once (ROOT
                    .DIRECTORY_SEPARATOR
                    .'app'
                    .DIRECTORY_SEPARATOR
                    .'config'
                    .DIRECTORY_SEPARATOR
                    .'components.php');
        
        foreach ($components as $obj => $component) {
            self::$objs[$obj] = new $component;
        }
    }
    
    public function __get($obj) 
    {
        if (is_object(self::$objs[$obj])) {
            return self::$objs[$obj];
        }
    }
    
    public function __set($obj, $component) 
    {
        if (!isset(self::$objs[$obj])) {
            self::$objs[$obj] = new $component;
        }
    }
}
