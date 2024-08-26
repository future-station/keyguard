<?php

namespace FutureStation\KeyGuard\Contracts;

interface ValidatorInterface
{
    /**
     * Validates the key and optionally the secret.
     *
     * @param string $key
     * @param string|null $secret
     * @return bool
     */
    public function validate(string $key, ?string $secret = null) : bool;
}