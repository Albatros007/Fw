<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core;

/**
 * Description of Cache
 *
 * @author Sirius7
 */
class Cache 
{
    public function set($key, $data, $timeOut = 3600) 
    {
        $content['data'] = $data;
        $content['timeOut'] = $timeOut + time();
        
        if (file_put_contents($this->getPath($key), serialize($content))) {
            return true;
        }
        
        throw new \Exception('Ошибка записи файла кэша');
    }
    
    public function get($key) 
    {
        $file = $this->getPath($key);
        
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if ($content['timeOut'] >= time() ) {
                return $content['data'];
            }
            unlink($file);        
        }
        
        return false;
    }
    
    private function getPath($key)
    {
        return CACHE
                .DIRECTORY_SEPARATOR
                .md5($key)
                .'.txt';
    }
}
