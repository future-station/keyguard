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

    /**
     * Get the validation status.
     */
    public function getStatus(): ValidationStatus
    {
        return $this->status;
    }

    /**
     * Get the validation message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the additional data associated with the validation.
     *
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
