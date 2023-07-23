<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class WrongCredentialException extends Exception
{
    public function __construct()
    {
        parent::__construct('Credentials are wrong! Try again.', Response::HTTP_BAD_REQUEST);
    }
}
