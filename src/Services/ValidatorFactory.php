<?php

namespace FutureStation\KeyGuard\Services;

use FutureStation\KeyGuard\Validators\BaseValidator;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use Http\Discovery\Psr18ClientDiscovery;
use FutureStation\KeyGuard\Enums\ServiceType;
use Psr\Http\Message\RequestFactoryInterface;
use FutureStation\KeyGuard\Contracts\FactoryInterface;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use FutureStation\KeyGuard\Validators\ShopifyValidator;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Validators\CompositeValidator;

class ValidatorFactory extends BaseValidator implements FactoryInterface
{
    public function create(ServiceType $service) : ValidatorInterface
    {
        return match ($service) {
            ServiceType::OPENAI => new OpenAIValidator($this->httpClient, $this->requestFactory),
            ServiceType::GITHUB => new GitHubValidator($this->httpClient, $this->requestFactory),
            ServiceType::SHOPIFY => new CompositeValidator([new ShopifyValidator()]),
            default => throw new \InvalidArgumentException("Unsupported service type: {$service->value}"),
        };
    }
}