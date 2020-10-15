<?php

namespace vendor\helpers;

class HTML 
{
    public static function a($path, $param)
    {
        return $path.'/'.$param;
    }
}
