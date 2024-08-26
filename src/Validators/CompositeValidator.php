<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;

class CompositeValidator implements ValidatorInterface
{
    /**
     * CompositeValidator constructor.
     *
     * @param  ValidatorInterface[]|HMACValidatorInterface[]  $validators
     */
    public function __construct(private readonly array $validators) {}

    /**
     * Validates the key and optionally the secret.
     */
    public function validate(string $key, ?string $secret = null): bool
    {
        foreach ($this->validators as $validator) {
            if (! $this->validateKey($validator, $key, $secret)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validates the key using the provided validator.
     *
     * @param  ValidatorInterface|HMACValidatorInterface  $validator
     */
    private function validateKey(object $validator, string $key, ?string $secret): bool
    {
        if ($validator instanceof ValidatorInterface && ! $validator->validate($key, $secret)) {
            return false;
        }

        if ($validator instanceof HMACValidatorInterface && $secret !== null) {
            return $this->validateHMAC($validator, $key, $secret);
        }

        return true;
    }

    /**
     * Validates HMAC if the validator supports it.
     */
    private function validateHMAC(HMACValidatorInterface $validator, string $key, string $secret): bool
    {
        $calculatedHash = base64_encode(hash_hmac('sha256', $key, $secret, true));

        return $validator->validateHMAC($key, $secret, $calculatedHash);
    }
}
