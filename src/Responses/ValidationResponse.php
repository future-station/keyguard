<?php

namespace FutureStation\KeyGuard\Responses;

use FutureStation\KeyGuard\Enums\ValidationStatus;

class ValidationResponse
{
    /**
     * ValidationResponse constructor.
     *
     * @param ValidationStatus $status
     * @param string $message
     * @param array<string, mixed> $data
     */
    public function __construct(
        private readonly ValidationStatus $status,
        private readonly string $message = '',
        private readonly array $data = []
    ) {
    }

    /**
     * Get the validation status.
     *
     * @return ValidationStatus
     */
    public function getStatus() : ValidationStatus
    {
        return $this->status;
    }

    /**
     * Get the validation message.
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Get the additional data associated with the validation.
     *
     * @return array<string, mixed>
     */
    public function getData() : array
    {
        return $this->data;
    }
}