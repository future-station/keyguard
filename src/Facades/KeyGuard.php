<?php

namespace FutureStation\KeyGuard\Facades;

use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\KeyGuard as KeyGuardService;
use FutureStation\KeyGuard\Responses\ValidationResponse;

class KeyGuard
{
    private static ?KeyGuardService $keyGuardInstance = null;

    /**
     * Set the KeyGuard instance (used for testing with mocks).
     */
    public static function setInstance(KeyGuardService $instance): void
    {
        self::$keyGuardInstance = $instance;
    }

    /**
     * Get or create the KeyGuard instance.
     */
    private static function getKeyGuardInstance(): KeyGuardService
    {
        if (! self::$keyGuardInstance instanceof KeyGuardService) {
            self::$keyGuardInstance = new KeyGuardService;
        }

        return self::$keyGuardInstance;
    }

    /**
     * Validate an API key using the specified service type.
     */
    public static function validate(
        ServiceType $service,
        string $key,
        ?string $secret = null,
        ?string $hash = null,
        ?string $data = null
    ): ValidationResponse {
        return self::getKeyGuardInstance()->validate($service, $key, $secret, $hash, $data);
    }

    /**
     * Validate an OpenAI API key.
     */
    public static function validateOpenAI(string $key): ValidationResponse
    {
        return self::validate(ServiceType::OPENAI, $key);
    }

    /**
     * Validate a GitHub API key.
     */
    public static function validateGitHub(string $key): ValidationResponse
    {
        return self::validate(ServiceType::GITHUB, $key);
    }

    /**
     * Validate a Shopify API key with HMAC.
     */
    public static function validateShopify(string $key, string $secret, string $hash, string $data): ValidationResponse
    {
        return self::validate(ServiceType::SHOPIFY, $key, $secret, $hash, $data);
    }
}
