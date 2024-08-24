<?php

namespace FutureStation\KeyGuard\Contracts;

use FutureStation\KeyGuard\Enums\ServiceType;

interface FactoryInterface
{
    public function create(ServiceType $service): ValidatorInterface;
}
