<?php

use FutureStation\KeyGuard\Exceptions\InvalidHMACException;
use FutureStation\KeyGuard\Validators\ShopifyValidator;

it('validates Shopify HMAC successfully', function () {
    $validator = new ShopifyValidator;

    $data = 'example data';
    $secret = 'secret_key';
    $hash = base64_encode(hash_hmac('sha256', $data, $secret, true));

    expect($validator->validateHMAC($data, $secret, $hash))->toBeTrue();
});

it('throws InvalidHMACException for invalid Shopify HMAC', function () {
    $validator = new ShopifyValidator;

    $data = 'example data';
    $secret = 'secret_key';
    $hash = 'invalid_hash';

    $this->expectException(InvalidHMACException::class);

    $validator->validateHMAC($data, $secret, $hash);
});
