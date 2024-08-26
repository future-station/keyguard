<?php

namespace FutureStation\KeyGuard\Validators;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\RequestFactoryInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;

class GitHubValidator extends BaseValidator implements ValidatorInterface
{
    public function validate(string $key, ?string $secret = null) : bool
    {
        $request = $this->createRequest($key);
        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid GitHub API Key');
        }

        return true;
    }

    private function createRequest(string $key) : RequestInterface
    {
        return $this->requestFactory
            ->createRequest('GET', 'https://api.github.com/user')
            ->withHeader('Authorization', 'Bearer ' . $key);
    }
}