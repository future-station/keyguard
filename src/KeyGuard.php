<?php

namespace FutureStation\KeyGuard;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Enums\ValidationStatus;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use FutureStation\KeyGuard\Responses\ValidationResponse;
use FutureStation\KeyGuard\Services\ValidatorFactory;

class KeyGuard
{
    private ValidatorFactory $validatorFactory;

    public function __construct(?ValidatorFactory $validatorFactory = null)
    {
        $this->validatorFactory = $validatorFactory ?: new ValidatorFactory;
    }

    public function validate(
        ServiceType $service,
        string $key,
        ?string $secret = null,
        ?string $hash = null,
        ?string $data = null
    ): ValidationResponse {
        $validator = $this->validatorFactory->create($service);

        try {
            $isValid = $this->performValidation($validator, $key, $secret, $hash, $data);
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

    private function performValidation(
        ValidatorInterface $validator,
        string $key,
        ?string $secret,
        ?string $hash,
        ?string $data
    ): bool {
        $isValid = $validator->validate($key, $secret);

        if ($validator instanceof HMACValidatorInterface && $hash && $secret && $data) {
            $isValid = $isValid && $validator->validateHMAC($data, $secret, $hash);
        }

        return $isValid;
    }
}
