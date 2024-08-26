<?php

namespace FutureStation\KeyGuard\Contracts;

use FutureStation\KeyGuard\Enums\ServiceType;

interface FactoryInterface
{
    /**
     * Creates a validator instance based on the provided service type.
     */
    public function create(ServiceType $service): ValidatorInterface;
}
