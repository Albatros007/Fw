<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core;

/**
 * Description of App
 *
 * @author Sirius7
 */
class Fw
{
    public static $app;

    public function __construct() 
    {
        self::$app = \vendor\core\Bootstrap::instance();
        new \vendor\core\ErrorHandler;
    }    
}
