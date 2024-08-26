<?php

namespace FutureStation\KeyGuard\Contracts;

interface ValidatorInterface
{
    /**
     * Validates the key and optionally the secret.
     */
    public function validate(string $key, ?string $secret = null): bool;
}
