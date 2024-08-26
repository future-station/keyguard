<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use Psr\Http\Message\RequestInterface;

class OpenAIValidator extends BaseValidator implements ValidatorInterface
{
    public function validate(string $key, ?string $secret = null): bool
    {
        $request = $this->createRequest($key);
        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid OpenAI API Key');
        }

        return true;
    }

    private function createRequest(string $key): RequestInterface
    {
        return $this->requestFactory
            ->createRequest('GET', 'https://api.openai.com/v1/models')
            ->withHeader('Authorization', 'Bearer '.$key);
    }
}
