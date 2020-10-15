<?php

namespace vendor\core;

class Router 
{
    private static $routes = [];
    private static $currentRoute = [];
    
    public static function addRout($regExp, $route = [])
    {
        self::$routes[$regExp] = $route;
    }
    
    public static function getRoutes()
    {
        return self::$routes;
    }
    
    public static function getCurrentRoute()
    {
        return self::$currentRoute;
    }
    
    private static function prepareClassName($str) 
    {
        return ucfirst($str);
    }
    
    private static function prepareActionName($str) 
    {
        if (strpos($str, '-')) {
            $tmp = explode('-', $str);
            $str = $tmp[0].ucfirst($tmp[1]);
        }
        
        return $str;
    }

    private static function Match()
    {
        $url = strtolower(rtrim($_SERVER['QUERY_STRING'], '/'));
              
        foreach (self::$routes as $regExp => $route) {
            
            if (preg_match('#'.$regExp.'#i', $url, $matches)) {
                
                self::$currentRoute['params'] = NULL;
                
                if (!empty($route[0])) {

                    self::$currentRoute['controller'] = $route[0];

                    if (!empty($route[1])) {
                        self::$currentRoute['action'] = $route[1];
                    }
                    
                    if (!empty($matches[1])) {
                        self::$currentRoute['params'] = $matches[1];
                    }

                } else {
                    
                    self::$currentRoute['controller'] = $matches[1];
                    
                    if (!empty($matches[2])) {
                        self::$currentRoute['action'] = $matches[2];
                    }
                    if (!empty($matches[3])) {
                        self::$currentRoute['params'] = $matches[3];
                    }
                    
                }
				
                if (empty(self::$currentRoute['action'])) {
                    self::$currentRoute['action'] = 'index';
                }
				
                //debug(self::$currentRoute);
                
                return true;
            } 
        }
        return false;
    }
    
    public static function Init()
    {
        if (self::Match()) {
			
            $controllerClass = 'app'
                                .DIRECTORY_SEPARATOR
                                .'controllers'
                                .DIRECTORY_SEPARATOR
                                .self::prepareClassName(self::$currentRoute['controller'])
                                .'Controller';
			
            if (class_exists($controllerClass)) {
				
                $cObj = new $controllerClass();

                $actionMethod = self::prepareActionName(self::$currentRoute['action']).'Action';
                //debug(self::$currentRoute);
                if (method_exists($cObj, $actionMethod)) {
                    
                    $cObj->render();
                    $cObj->$actionMethod(self::$currentRoute['params']);
                    $cObj->render->init();

                } else {
                    throw new NotFoundExeption('Экшен '.$actionMethod.' не найден');
                }
				
            } else {
                throw new NotFoundExeption('Контроллер '.$controllerClass.' не найден');	
            }
			
        } else {
            throw new NotFoundExeption('Маршрут не найден');
        }
    }
}
