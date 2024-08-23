<?php

namespace FutureStation\KeyGuard\Services;

use FutureStation\KeyGuard\Contracts\FactoryInterface;
use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Validators\GeminiValidator;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use FutureStation\KeyGuard\Validators\ShopifyValidator;

class ValidatorFactory implements FactoryInterface
{
    private HMACValidatorInterface $hmacValidator;

    public function __construct(HMACValidatorInterface $hmacValidator)
    {
        $this->hmacValidator = $hmacValidator;
    }

    public function create(string $service): ValidatorInterface
    {
        return match ($service) {
            ServiceType::OPENAI  => new OpenAIValidator($this->hmacValidator),
            ServiceType::GITHUB  => new GitHubValidator($this->hmacValidator),
            ServiceType::SHOPIFY => new ShopifyValidator($this->hmacValidator),
            ServiceType::GEMINI  => new GeminiValidator($this->hmacValidator),
            default              => throw new \InvalidArgumentException("Unknown service: $service"),
        };
    }
}
