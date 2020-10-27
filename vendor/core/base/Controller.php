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

    /*
     * Вызывется автоматически из vendor\core\Router при
     * установленной константе RENDER_TYPE в положение 1, т.е. в авто
     * */
    public function render()
    {
        $route = Router::getCurrentRoute();
        $this->render = new Render($route['controller'], $route['action']);
    }
 }