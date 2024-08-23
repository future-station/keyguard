<?php

namespace FutureStation\KeyGuard\Exceptions;

use Exception;

class InvalidApiKeyException extends Exception
{
    protected $message = 'The provided API key is invalid.';
}
