<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidHMACException;

class ShopifyValidator implements HMACValidatorInterface
{
    /**
     * Validates the provided HMAC hash.
     *
     * @param string $data
     * @param string $secret
     * @param string $hash
     * @return bool
     * @throws InvalidHMACException
     */
    public function validateHMAC(string $data, string $secret, string $hash) : bool
    {
        $calculatedHash = $this->calculateHMAC($data, $secret);

        if (! hash_equals($calculatedHash, $hash)) {
            throw new InvalidHMACException('Provided HMAC hash does not match the calculated hash.');
        }

        return true;
    }

    /**
     * Calculates the HMAC hash using SHA-256.
     *
     * @param string $data
     * @param string $secret
     * @return string
     */
    private function calculateHMAC(string $data, string $secret) : string
    {
        return base64_encode(hash_hmac('sha256', $data, $secret, true));
    }
}