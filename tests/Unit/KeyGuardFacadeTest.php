<?php

use FutureStation\KeyGuard\Facades\KeyGuard;
use FutureStation\KeyGuard\Enums\ServiceType;
use FutureStation\KeyGuard\Responses\ValidationResponse;
use FutureStation\KeyGuard\Enums\ValidationStatus;
use FutureStation\KeyGuard\KeyGuard as KeyGuardService;
use Mockery\MockInterface;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

uses(MockeryPHPUnitIntegration::class);

beforeEach(function () {
    $this->keyGuardMock = Mockery::mock(KeyGuardService::class);

    KeyGuard::setInstance($this->keyGuardMock);

    $this->keyGuardMock->shouldReceive('validate')
        ->with(ServiceType::OPENAI, 'valid-openai-key', null, null, null)
        ->andReturn(new ValidationResponse(ValidationStatus::VALID, 'Valid OpenAI key', []));

    $this->keyGuardMock->shouldReceive('validate')
        ->with(ServiceType::GITHUB, 'valid-github-key', null, null, null)
        ->andReturn(new ValidationResponse(ValidationStatus::VALID, 'Valid GitHub key', []));

    $this->keyGuardMock->shouldReceive('validate')
        ->with(ServiceType::SHOPIFY, 'valid-shopify-key', 'shopify-secret', 'valid-hmac', 'some-data')
        ->andReturn(new ValidationResponse(ValidationStatus::VALID, 'Valid Shopify key with HMAC', []));
});

it('validates OpenAI API key using facade', function () {
    $response = KeyGuard::validateOpenAI('valid-openai-key');

    expect($response)->toBeInstanceOf(ValidationResponse::class)
        ->and($response->getStatus())->toBe(ValidationStatus::VALID);
});

it('validates GitHub API key using facade', function () {
    $response = KeyGuard::validateGitHub('valid-github-key');

    expect($response)->toBeInstanceOf(ValidationResponse::class)
        ->and($response->getStatus())->toBe(ValidationStatus::VALID);
});

it('validates Shopify API key with HMAC using facade', function () {
    $response = KeyGuard::validateShopify('valid-shopify-key', 'shopify-secret', 'valid-hmac', 'some-data');

    expect($response)->toBeInstanceOf(ValidationResponse::class)
        ->and($response->getStatus())->toBe(ValidationStatus::VALID);
});

it('throws exception for invalid service type using facade', function () {
    $this->keyGuardMock->shouldReceive('validate')
        ->andThrow(new InvalidArgumentException('Unsupported service type'));

    expect(fn () => KeyGuard::validate(ServiceType::SHOPIFY, 'invalid-key'))
        ->toThrow(InvalidArgumentException::class);
});

afterEach(function () {
    Mockery::close();
});