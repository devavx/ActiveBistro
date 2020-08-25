<?php

namespace App\Exceptions;

use Exception;

class MaxQuantityReachedException extends Exception
{
    public function __construct($message = "No more items allowed.")
    {
        parent::__construct($message);
    }
}
