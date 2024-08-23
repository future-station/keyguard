<?php

namespace FutureStation\KeyGuard\Contracts;

interface FactoryInterface
{
    public function create(string $service): ValidatorInterface;
}
