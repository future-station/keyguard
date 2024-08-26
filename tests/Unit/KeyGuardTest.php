<?php

use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\KeyGuard;
use FutureStation\KeyGuard\Services\ValidatorFactory;
use Tests\Fixtures\MockHttpClient;
use Tests\Fixtures\MockRequestFactory;

it('validates OpenAI service with correct API key', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validatorFactory = new ValidatorFactory($httpClient, $requestFactory);
    $keyGuard = new KeyGuard($validatorFactory);

    $response = $keyGuard->validate(ServiceType::OPENAI, 'valid_openai_api_key');

    expect($response->getStatus())->toBe('valid');
});

it('validates Shopify service with correct HMAC', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validatorFactory = new ValidatorFactory($httpClient, $requestFactory);
    $keyGuard = new KeyGuard($validatorFactory);

    $data = 'example data';
    $secret = 'secret_key';
    $hash = base64_encode(hash_hmac('sha256', $data, $secret, true));

    $response = $keyGuard->validate(ServiceType::SHOPIFY, 'api_key', $secret, $hash, $data);

    expect($response->getStatus())->toBe('valid');
})->skip('This test is skipped because the HMAC validation is not yet implemented.');

it('fails validation for OpenAI service with incorrect API key', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validatorFactory = new ValidatorFactory($httpClient, $requestFactory);
    $keyGuard = new KeyGuard($validatorFactory);

    $response = $keyGuard->validate(ServiceType::OPENAI, 'invalid_openai_api_key');

    expect($response->getStatus())->toBe('invalid');
});
