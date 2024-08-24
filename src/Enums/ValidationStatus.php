<?php

namespace FutureStation\KeyGuard\Enums;

enum ValidationStatus: string
{
    case VALID = 'valid';
    case INVALID = 'invalid';
    case ERROR = 'error';

    public function getMessage(): string
    {
        return match ($this) {
            self::VALID => 'Validation successful.',
            self::INVALID => 'Validation failed.',
            self::ERROR => 'An error occurred during validation.',
        };
    }
}
