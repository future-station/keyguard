<?php

namespace FutureStation\KeyGuard\Validators;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\RequestFactoryInterface;
use FutureStation\KeyGuard\Validators\BaseValidator;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;

class OpenAIValidator extends BaseValidator implements ValidatorInterface
{
    public function validate(string $key, ?string $secret = null) : bool
    {
        $request = $this->createRequest($key);
        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid OpenAI API Key');
        }

        return true;
    }

    private function createRequest(string $key) : RequestInterface
    {
        return $this->requestFactory
            ->createRequest('GET', 'https://api.openai.com/v1/models')
            ->withHeader('Authorization', 'Bearer ' . $key);
    }
}