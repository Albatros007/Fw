<?php

namespace vendor\core;

 
trait SingletoneTrait 
{
    private static $instance;

    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
 
}
