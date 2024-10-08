<?php

namespace FutureStation\KeyGuard\Services;

use FutureStation\KeyGuard\Contracts\FactoryInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Validators\BaseValidator;
use FutureStation\KeyGuard\Validators\CompositeValidator;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use FutureStation\KeyGuard\Validators\ShopifyValidator;

class ValidatorFactory extends BaseValidator implements FactoryInterface
{
    public function create(ServiceType $service): ValidatorInterface
    {
        return match ($service) {
            ServiceType::OPENAI => new OpenAIValidator($this->httpClient, $this->requestFactory),
            ServiceType::GITHUB => new GitHubValidator($this->httpClient, $this->requestFactory),
            ServiceType::SHOPIFY => new CompositeValidator([new ShopifyValidator]),
            default => throw new \InvalidArgumentException("Unsupported service type: {$service->value}") // @phpstan-ignore-line
        };
    }
}
