<?php

namespace FutureStation\KeyGuard\Services;

use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Validators\CompositeValidator;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use FutureStation\KeyGuard\Validators\ShopifyValidator;
use GuzzleHttp\Psr7\HttpFactory;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class ValidatorFactory
{
    private readonly ClientInterface $httpClient;

    private readonly RequestFactoryInterface $requestFactory;

    public function __construct(?ClientInterface $httpClient = null, ?RequestFactoryInterface $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: new HttpFactory;
    }

    public function create(ServiceType $service): ValidatorInterface
    {
        return match ($service) {
            ServiceType::OPENAI => new OpenAIValidator($this->httpClient, $this->requestFactory),
            ServiceType::GITHUB => new GitHubValidator($this->httpClient, $this->requestFactory),
            ServiceType::SHOPIFY => new CompositeValidator([
                new ShopifyValidator, // ValidatorInterface + HMACValidatorInterface
            ]),
        };
    }
}
