<?php

namespace vendor\core\base;

use vendor\core\Router;
use vendor\core\Render;

abstract class Controller
{
    public $render;
    public $useDb = true;
    
    public function __construct() 
    {
        if ($this->useDb) {
            \vendor\core\Db::instance();
        }
    }
    
    public function render()
    {
        $route = Router::getCurrentRoute();
        $this->render = new Render($route['controller'], $route['action']);
    }
 }