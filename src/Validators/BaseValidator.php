<?php

namespace FutureStation\KeyGuard\Validators;

use GuzzleHttp\Psr7\HttpFactory;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

abstract class BaseValidator
{
    protected readonly ClientInterface $httpClient;

    protected readonly RequestFactoryInterface $requestFactory;

    public function __construct(?ClientInterface $httpClient = null, ?RequestFactoryInterface $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: new HttpFactory;
    }
}
