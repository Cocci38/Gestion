<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception{
    
    // Un constructeur qui attends le message 
    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        // On récupère le constructeur parent
        parent :: __construct($message, $code, $previous); 
    }
}


?>