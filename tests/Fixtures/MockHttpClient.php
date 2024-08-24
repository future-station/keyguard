<?php

namespace Tests\Fixtures;

use FutureStation\KeyGuard\Enums\ServiceType;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MockHttpClient implements ClientInterface
{
    private array $serviceHandlers;

    public function __construct()
    {
        $this->serviceHandlers = [
            ServiceType::OPENAI->value => fn ($authorizationHeader) => $this->handleOpenAIRequest($authorizationHeader),
            ServiceType::GITHUB->value => fn ($authorizationHeader) => $this->handleGitHubRequest($authorizationHeader),
        ];
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $uri = (string) $request->getUri();
        $authorizationHeader = $request->getHeaderLine('Authorization');

        $serviceType = $this->determineServiceType($uri);

        if ($serviceType && isset($this->serviceHandlers[$serviceType->value])) {
            return ($this->serviceHandlers[$serviceType->value])($authorizationHeader);
        }

        return new Response(200, [], json_encode(['success' => true]));
    }

    private function determineServiceType(string $uri): ?ServiceType
    {
        if (strpos($uri, 'openai.com') !== false) {
            return ServiceType::OPENAI;
        }

        if (strpos($uri, 'github.com') !== false) {
            return ServiceType::GITHUB;
        }

        return null;
    }

    private function handleOpenAIRequest(string $authorizationHeader): ResponseInterface
    {
        if ($authorizationHeader === 'Bearer invalid_openai_api_key') {
            return new Response(401, [], json_encode(['error' => 'Invalid API Key']));
        }

        return new Response(200, [], json_encode(['success' => true]));
    }

    private function handleGitHubRequest(string $authorizationHeader): ResponseInterface
    {
        if ($authorizationHeader === 'Bearer invalid_github_api_key') {
            return new Response(401, [], json_encode(['error' => 'Invalid API Key']));
        }

        return new Response(200, [], json_encode(['success' => true]));
    }
}
