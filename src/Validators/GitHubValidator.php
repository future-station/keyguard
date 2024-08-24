<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class GitHubValidator implements ValidatorInterface
{
    public function __construct(private readonly ClientInterface $httpClient, private readonly RequestFactoryInterface $requestFactory) {}

    public function validate(string $key, ?string $secret = null): bool
    {
        $request = $this->requestFactory->createRequest('POST', 'https://api.github.com/v1/endpoints')
            ->withHeader('Authorization', 'Bearer '.$key);

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid GitHub API Key');
        }

        return true;
    }
}
