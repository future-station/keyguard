<?php

use FutureStation\KeyGuard\Exceptions\InvalidApiKeyException;
use FutureStation\KeyGuard\Utils\HMACValidator;
use FutureStation\KeyGuard\Validators\OpenAIValidator;
use PHPUnit\Framework\TestCase;

class OpenAIValidatorTest extends TestCase
{
    public function testValidateSuccess()
    {
        $hmacValidator = new HMACValidator();
        $validator     = new OpenAIValidator($hmacValidator);

        // Assuming we have a mock HTTP client or similar setup
        $this->assertTrue($validator->validate('openai-valid-key'));
    }

    public function testValidateFailure()
    {
        $this->expectException(InvalidApiKeyException::class);

        $hmacValidator = new HMACValidator();
        $validator     = new OpenAIValidator($hmacValidator);

        // Assuming we have a mock HTTP client or similar setup
        $validator->validate('openai-invalid-key');
    }
}
