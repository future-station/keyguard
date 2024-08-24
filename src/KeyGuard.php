<?php

namespace FutureStation\KeyGuard;

use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Services\ValidatorFactory;
use FutureStation\KeyGuard\Responses\ValidationResponse;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Enums\ValidationStatus;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;

class KeyGuard
{
    private ValidatorFactory $validatorFactory;

    public function __construct(ValidatorFactory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function validate(ServiceType $service, string $key, ?string $secret = null, ?string $hash = null, ?string $data = null) : ValidationResponse
    {
        $validator = $this->validatorFactory->create($service);

        try {
            // Validate the API key and secret
            $isValid = $validator->validate($key, $secret);

            // If a hash and data are provided, and the validator supports HMAC, perform HMAC validation
            if ($hash !== null && $data !== null && $validator instanceof HMACValidatorInterface) {
                $isValid = $isValid && $validator->validateHMAC($data, $secret, $hash);
            }

            $status = $isValid ? ValidationStatus::VALID : ValidationStatus::INVALID;
        } catch (InvalidApiKeyException $e) {
            $status = ValidationStatus::INVALID;
        } catch (\Exception $e) {
            $status = ValidationStatus::ERROR;
        }

        return new ValidationResponse(
            $status,
            "Validation for {$service->value} completed.",
            [$service->value => $status->getMessage()]
        );
    }
}
