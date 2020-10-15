<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vendor\core;

/**
 * Description of NotFoundExeption
 *
 * @author Sirius7
 */
class NotFoundExeption extends \Exception
{
    public function __construct($message='', $code=404) {
        parent::__construct($message, $code);
    }
}
