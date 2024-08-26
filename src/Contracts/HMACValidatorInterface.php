<?php

namespace FutureStation\KeyGuard\Contracts;

interface HMACValidatorInterface
{
    /**
     * Validates the HMAC hash.
     *
     * @param string $data
     * @param string $secret
     * @param string $hash
     * @return bool
     */
    public function validateHMAC(string $data, string $secret, string $hash) : bool;
}