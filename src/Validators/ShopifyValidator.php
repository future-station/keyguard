<?php

namespace FutureStation\KeyGuard\Validators;

use FutureStation\KeyGuard\Contracts\HMACValidatorInterface;
use FutureStation\KeyGuard\Contracts\ValidatorInterface;
use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use GuzzleHttp\Client;

class ShopifyValidator implements ValidatorInterface
{
    private HMACValidatorInterface $hmacValidator;
    private Client $client;

    public function __construct(HMACValidatorInterface $hmacValidator)
    {
        $this->hmacValidator = $hmacValidator;
        $this->client        = new Client();
    }

    public function validate(string $key, ?string $secret = null): bool
    {
        $response = $this->client->get('https://' . $key . '.myshopify.com/admin/shop.json', [
            'headers' => [
                'X-Shopify-Access-Token' => $secret,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new InvalidApiKeyException('Invalid Shopify API Key or Secret');
        }

        return true;
    }
}
