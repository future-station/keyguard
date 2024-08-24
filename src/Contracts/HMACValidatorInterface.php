<?php

namespace FutureStation\KeyGuard\Contracts;

interface HMACValidatorInterface
{
    public function validateHMAC(string $data, string $secret, string $hash): bool;
}
