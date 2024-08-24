<?php

namespace FutureStation\KeyGuard\Responses;

use FutureStation\KeyGuard\Enums\ValidationStatus;

class ValidationResponse
{
    private ValidationStatus $status;

    private string $message;

    private array $data;

    public function __construct(ValidationStatus $status, string $message = '', array $data = [])
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public function getStatus(): ValidationStatus
    {
        return $this->status;
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
