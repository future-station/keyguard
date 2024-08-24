<?php

namespace FutureStation\KeyGuard\Contracts;

interface ValidatorInterface
{
    public function validate(string $key, ?string $secret = null) : bool;
}
