<?php

namespace FutureStation\KeyGuard\Contracts;

interface HMACValidatorInterface
{
    public function validate(string $data, string $secret, string $hash): bool;
}
