<?php

namespace FutureStation\KeyGuard;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Enums\ValidationStatus;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use FutureStation\KeyGuard\Responses\ValidationResponse;
use FutureStation\KeyGuard\Services\ValidatorFactory;

class KeyGuard
{
    public function __construct(private readonly ValidatorFactory $validatorFactory) {}

    public function validate(ServiceType $service, string $key, ?string $secret = null, ?string $hash = null, ?string $data = null): ValidationResponse
    {
        $validator = $this->validatorFactory->create($service);

        try {
            // Validate the API key and secret
            $isValid = $validator->validate($key, $secret);

            // If a hash and data are provided, and the validator supports HMAC, perform HMAC validation
            if ($hash !== null && $secret !== null && $data !== null && $validator instanceof HMACValidatorInterface) {
                $isValid = $isValid && $validator->validateHMAC($data, $secret, $hash);
            }

            $status = $isValid ? ValidationStatus::VALID : ValidationStatus::INVALID;
        } catch (InvalidApiKeyException) {
            $status = ValidationStatus::INVALID;
        } catch (\Exception) {
            $status = ValidationStatus::ERROR;
        }

        return new ValidationResponse(
            $status,
            "Validation for {$service->value} completed.",
            [$service->value => $status->getMessage()]
        );
    }
}
