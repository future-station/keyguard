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
    public function __construct(string $message = 'HMAC validation failed.', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
