<?php

namespace FutureStation\KeyGuard\Utils;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;

class HMACValidator implements HMACValidatorInterface
{
    public function validate(string $data, string $secret, string $hash): bool
    {
        $calculatedHash = hash_hmac('sha256', $data, $secret);
        return hash_equals($calculatedHash, $hash);
    }
}
