<?php

namespace FutureStation\KeyGuard\Responses;

class ValidationResponse
{
    private bool $isValid;
    private string $message;
    private array $data;

    public function __construct(bool $isValid, string $message = '', array $data = [])
    {
        $this->isValid = $isValid;
        $this->message = $message;
        $this->data    = $data;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
