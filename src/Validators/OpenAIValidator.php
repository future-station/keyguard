<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use GuzzleHttp\Client;

class OpenAIValidator implements ValidatorInterface
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
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $key,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'model'    => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role'    => 'system',
                        'content' => 'You are a helpful assistant.'
                    ],
                    [
                        'role'    => 'user',
                        'content' => 'What is a LLM?'
                    ],
                ],
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid OpenAI API Key');
        }

        return true;
    }
}
