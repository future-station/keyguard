<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;

class CompositeValidator implements ValidatorInterface
{
    public function __construct(
        /**
         * @var array<ValidatorInterface|HMACValidatorInterface>
         */
        private readonly array $validators
    ) {}

    /**
     * Validate the API key and optionally HMAC.
     */
    public function validate(string $key, ?string $secret = null): bool
    {
        foreach ($this->validators as $validator) {
            // If the validator is a standard API key validator
            if ($validator instanceof ValidatorInterface && ! $validator->validate($key, $secret)) {
                return false;
            }

            // If the validator is an HMAC validator
            if ($validator instanceof HMACValidatorInterface && ($secret === null || ! $validator->validateHMAC($key, $secret, $key))) {
                return false;
            }
        }

        return true;
    }
}
