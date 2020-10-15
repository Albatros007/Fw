<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core;

/**
 * Description of Db
 *
 * @author Sirius7
 */
class Db 
{
    use SingletoneTrait;
    
    private function __construct() 
    {
        $connect = require_once (ROOT
                    .DIRECTORY_SEPARATOR
                    .'app'
                    .DIRECTORY_SEPARATOR
                    .'config'
                    .DIRECTORY_SEPARATOR
                    .'db.php');
        
        require_once (ROOT
                    .DIRECTORY_SEPARATOR
                    .'vendor'
                    .DIRECTORY_SEPARATOR
                    .'assets'
                    .DIRECTORY_SEPARATOR
                    .'rb-mysql.php');
         
        \R::setup($connect['dsn'], $connect['user'], $connect['pass'], false);
        //\R::fancyDebug(true);
        //if(\R::testConnection()) echo 'Ok';
    }
}
