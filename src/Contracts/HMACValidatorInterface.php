<?php

namespace FutureStation\KeyGuard\Contracts;

interface HMACValidatorInterface
{
    /**
     * Validates the HMAC hash.
     */
    public function validateHMAC(string $data, string $secret, string $hash): bool;
}
