<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;

class CompositeValidator implements ValidatorInterface
{
    /**
     * @var ValidatorInterface[]|HMACValidatorInterface[]
     */
    private array $validators;

    /**
     * CompositeValidator constructor.
     *
     * @param ValidatorInterface[]|HMACValidatorInterface[] $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Validates the key and optionally the secret.
     *
     * @param string $key
     * @param string|null $secret
     * @return bool
     */
    public function validate(string $key, ?string $secret = null) : bool
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
     * @param ValidatorInterface|HMACValidatorInterface $validator
     * @param string $key
     * @param string|null $secret
     * @return bool
     */
    private function validateKey(object $validator, string $key, ?string $secret) : bool
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
     *
     * @param HMACValidatorInterface $validator
     * @param string $key
     * @param string $secret
     * @return bool
     */
    private function validateHMAC(HMACValidatorInterface $validator, string $key, string $secret) : bool
    {
        $calculatedHash = base64_encode(hash_hmac('sha256', $key, $secret, true));
        return $validator->validateHMAC($key, $secret, $calculatedHash);
    }
}