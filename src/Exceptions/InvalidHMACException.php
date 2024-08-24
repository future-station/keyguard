<?php

namespace FutureStation\KeyGuard\Exceptions;

use Exception;

class InvalidHMACException extends Exception
{
    /**
     * Constructor for InvalidHMACException.
     *
     * @param  string  $message  The custom error message (optional).
     * @param  int  $code  The custom error code (optional).
     * @param  Exception|null  $previous  The previous exception used for exception chaining (optional).
     */
    public function __construct($message = 'HMAC validation failed.', $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
