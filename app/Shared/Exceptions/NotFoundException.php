<?php

namespace App\Shared\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct(string $message){
        parent::__construct($message);
    }
}
