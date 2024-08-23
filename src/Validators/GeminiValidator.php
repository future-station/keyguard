<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use GuzzleHttp\Client;

class GeminiValidator implements ValidatorInterface
{
    private HMACValidatorInterface $hmacValidator;
    private Client $client;

    public function __construct(HMACValidatorInterface $hmacValidator)
    {
        $this->hmacValidator = $hmacValidator;
        $this->client        = new Client();
    }

    public function validate(string $key, ?string $secret = null): bool
    {
        // Implement Gemini-specific validation logic here
        return true;
    }
}
