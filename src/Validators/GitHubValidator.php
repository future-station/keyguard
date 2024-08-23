<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use GuzzleHttp\Client;

class GitHubValidator implements ValidatorInterface
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
        $response = $this->client->get('https://api.github.com/user', [
            'headers' => [
                'Authorization' => 'token ' . $key,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid GitHub Token');
        }

        return true;
    }
}
