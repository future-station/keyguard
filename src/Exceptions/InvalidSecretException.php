<?php

namespace FutureStation\KeyGuard\Exceptions;

use Exception;

class InvalidSecretException extends Exception
{
    protected $message = 'The provided secret key is invalid.';
}
