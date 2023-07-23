<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class WrongCredentialException extends Exception
{
    const MESSAGE = 'Credentials are wrong! Try again.';
    public function __construct()
    {
        parent::__construct(self::MESSAGE, Response::HTTP_BAD_REQUEST);
    }
}
