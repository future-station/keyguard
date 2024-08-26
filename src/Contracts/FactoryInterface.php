<?php

namespace FutureStation\KeyGuard\Contracts;

use FutureStation\KeyGuard\Enums\ServiceType;

interface FactoryInterface
{
    /**
     * Creates a validator instance based on the provided service type.
     *
     * @param ServiceType $service
     * @return ValidatorInterface
     */
    public function create(ServiceType $service) : ValidatorInterface;
}