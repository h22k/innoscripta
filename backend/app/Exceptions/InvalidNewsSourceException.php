<?php

namespace App\Exceptions;

use Exception;

class InvalidNewsSourceException extends Exception
{
    public function __construct(string $source)
    {
        parent::__construct("There is no source named $source!");
    }
}
