<?php

use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use Tests\Fixtures\MockHttpClient;
use Tests\Fixtures\MockRequestFactory;

it('validates OpenAI API key successfully', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validator = new OpenAIValidator($httpClient, $requestFactory);

    expect($validator->validate('valid_openai_api_key'))->toBeTrue();
});

it('throws InvalidApiKeyException for invalid OpenAI API key', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validator = new OpenAIValidator($httpClient, $requestFactory);

    $this->expectException(InvalidApiKeyException::class);

    $validator->validate('invalid_openai_api_key');
});
