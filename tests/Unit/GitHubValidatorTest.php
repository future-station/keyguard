<?php

use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use FutureStation\KeyGuard\Validators\GitHubValidator;
use Tests\Fixtures\MockHttpClient;
use Tests\Fixtures\MockRequestFactory;

it('validates GitHub API key successfully', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validator = new GitHubValidator($httpClient, $requestFactory);

    expect($validator->validate('valid_github_api_key'))->toBeTrue();
});

it('throws InvalidApiKeyException for invalid GitHub API key', function () {
    $httpClient = new MockHttpClient;
    $requestFactory = new MockRequestFactory;

    $validator = new GitHubValidator($httpClient, $requestFactory);

    expect(fn () => $validator->validate('invalid_github_api_key'))
        ->toThrow(InvalidApiKeyException::class);
});
