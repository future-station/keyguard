<?php

namespace FutureStation\KeyGuard\Responses;

use FutureStation\KeyGuard\Enums\ValidationStatus;

class ValidationResponse
{
    /**
     * ValidationResponse constructor.
     *
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        private readonly ValidationStatus $status,
        private readonly string $message = '',
        private readonly array $data = []
    ) {}

    public function getStatus(): ValidationStatus
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
