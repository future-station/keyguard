<?php

namespace FutureStation\KeyGuard\Validators;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;

class GitHubValidator implements ValidatorInterface
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    public function validate(string $key, ?string $secret = null) : bool
    {
        $request = $this->requestFactory->createRequest('POST', 'https://api.GitHub.com/v1/engines')
            ->withHeader('Authorization', 'Bearer ' . $key);

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid GitHub API Key');
        }

        return true;
    }
}
