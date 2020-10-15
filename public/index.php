<?php

use vendor\core\Router;
use vendor\core\Fw;

define('DEBUG', 1);

define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
//define('ERROR_LOG', dirname(__DIR__).'/app/tmp/error.html');
define('ERROR_LOG', 0);
define('CACHE', dirname(__DIR__).'/tmp/cache');

spl_autoload_register(function($class){
    $file = ROOT.DIRECTORY_SEPARATOR.$class.'.php';
    if (file_exists($file)){
        require_once $file;
    }
});

new Fw;

//Fw::$app->cache->eh();

//sd();
//echo $sdf;
//throw new Exception('404', 404);
//throw new NotFoundExeption('404');

Router::addRout('^news$', ['news']);
Router::addRout('^news/([\d]+)$', ['news', 'solo']);
Router::addRout('^news/([\d]{4}-[\d]{2}-[\d]{2})$', ['news', 'calendar']);

Router::addRout('^$', ['main', 'index']);
Router::addRout('^([a-z-]+)/?([a-z-]+)?/?([0-9]+)?$');

Router::Init();

//debug(Router::getCurrentRoute());

function debug($var) 
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}