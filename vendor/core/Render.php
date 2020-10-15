<?php

namespace vendor\core;

class Render 
{
    private $layout = 'main';
    private $view;
    private $path;
    private $data;
    
    public function __construct($path, $view) 
    {
        $this->view = $view;
        $this->path = $path;
    }
    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    public function setView($view)
    {
        $this->view = $view;
    }
    
    public function setPath($path)
    {
        $this->path = $path;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
    
    public function ajax($data=false, $viewFile=false) 
    {
        if (!$viewFile) {
            $viewFile =  APP
                        .DIRECTORY_SEPARATOR
                        .'views'
                        .DIRECTORY_SEPARATOR
                        .$this->path
                        .DIRECTORY_SEPARATOR
                        .$this->view
                        .'.php';
        }
        
        if (!empty($data)) {
            extract($data);
        }
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            throw new NotFoundExeption('Вид '.$viewFile.' не найден');
        }
        
    }
    
    public function init() 
    {
        if ($this->layout !== false) {
            
            if (!empty($this->data)) {
                extract($this->data);
            }
            
            ob_start();

            $viewFile =  APP
                        .DIRECTORY_SEPARATOR
                        .'views'
                        .DIRECTORY_SEPARATOR
                        .$this->path
                        .DIRECTORY_SEPARATOR
                        .$this->view
                        .'.php';

            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                throw new NotFoundExeption('Вид '.$viewFile.' не найден');
            }

            $content = ob_get_clean();

            $layoutFile = APP
                        .DIRECTORY_SEPARATOR
                        .'views'
                        .DIRECTORY_SEPARATOR
                        .'layouts'
                        .DIRECTORY_SEPARATOR
                        .$this->layout
                        .'.php';

            if (file_exists($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new NotFoundExeption('Layout '.$layoutFile.' не найден');
            }
        }
    }
}
