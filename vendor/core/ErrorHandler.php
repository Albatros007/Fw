<?php

namespace vendor\core;

class ErrorHandler 
{
    public function __construct() 
    {
        set_error_handler([$this, 'noticeError']);
        set_exception_handler([$this, 'exeptionError']);
        
        ob_start();
        register_shutdown_function([$this, 'fatalError']);
    }
    
    public function noticeError($errNo, $errStr, $errFile, $errLine)
    {
        $this->setError($errNo, $errStr, $errFile, $errLine, 'notice');
        return true;
    }
    
    public function fatalError()
    {
        $error = error_get_last();
        
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            ob_end_clean();
            $this->setError($error['type'], $error['message'], $error['file'], $error['line'], 'fatal');
        } else {
            ob_end_flush();
        }
    }
    
    public function exeptionError(\Exception $e)
    {
        $this->setError('', $e->getMessage(), $e->getFile(), $e->getLine(), 'exeption', $e->getCode());
    }
    
    private function errorLog($errStr, $errFile, $errLine, $errType, $response) 
    {
        
        if ($response == 404) {
            $errStr = $errStr .' | '.$_SERVER['QUERY_STRING'];
        }
        
        error_log(
                date('Y-m-d H:i:s')
                .' | '
                .ucfirst($errType)
                .' | '
                .$errStr
                .' | '
                .$errFile
                .' | '
                .$errLine
                .' | '
                .$response
                .'<br />--------------------------------------------------------<br />'
        , 3, ERROR_LOG);
    }

    private function setError($errNo, $errStr, $errFile, $errLine, $errType, $response = 500)
    {
       $path = APP
            .DIRECTORY_SEPARATOR
            .'views'
            .DIRECTORY_SEPARATOR
            .'errors'
            .DIRECTORY_SEPARATOR;
        
        if (DEBUG) {
            require_once $path.'dev.php';
        } else {
            
            if ($response == 404) {
                require_once $path.'404.html';
            } else {
                require_once $path.'prod.php';
            }
            
        }
        
        if (ERROR_LOG) {
            $this->errorLog($errStr, $errFile, $errLine, $errType, $response);
        }
        http_response_code($response);
        exit();
    }
}
