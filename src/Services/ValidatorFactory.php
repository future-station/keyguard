<?php

namespace FutureStation\KeyGuard\Services;

use Psr\Http\Client\ClientInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use Psr\Http\Message\RequestFactoryInterface;
use FutureStation\KeyGuard\Contracts\FactoryInterface;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use FutureStation\KeyGuard\Validators\ShopifyValidator;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;

class ValidatorFactory implements FactoryInterface
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    public function create(ServiceType $service) : ValidatorInterface
    {
        switch ($service) {
            case ServiceType::OPENAI:
                return new OpenAIValidator($this->httpClient, $this->requestFactory);
            case ServiceType::GITHUB:
                return new GitHubValidator($this->httpClient, $this->requestFactory);
            case ServiceType::SHOPIFY:
                return new ShopifyValidator();
            default:
                throw new \InvalidArgumentException("Unknown service: $service->value");
        }
    }
}
