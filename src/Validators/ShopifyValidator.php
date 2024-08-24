<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidHMACException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class ShopifyValidator implements HMACValidatorInterface
{
    public function validateHMAC(string $data, string $secret, string $hash) : bool
    {
        // Calculate the HMAC using SHA-256
        $calculatedHash = base64_encode(hash_hmac('sha256', $data, $secret, true));

        // Compare the calculated hash with the provided hash
        if (! hash_equals($calculatedHash, $hash)) {
            throw new InvalidHMACException('Provided HMAC hash does not match the calculated hash.');
        }

        return true;
    }
}
