<?php

namespace Auth\Token;

use App\Auth\Token\ParenthesisAuthToken;
use PHPUnit\Framework\TestCase;

class ParenthesisAuthTokenTest extends TestCase
{
    protected const VALID_TOKENS = [
        '', '{}', '[]', '()', '{}[]()', '{([])}'
    ];

    protected const INVALID_TOKENS = [
        '{)', '[{]}', '(((((((()', '(', ')'
    ];

    public function test_valid_tokens(): void
    {
        $parenthesisAuthToken = new ParenthesisAuthToken();

        foreach (self::VALID_TOKENS as $token) {
            $this->assertTrue($parenthesisAuthToken->isValid($token));
        }
    }

    public function test_invalid_tokens(): void
    {
        $parenthesisAuthToken = new ParenthesisAuthToken();

        foreach (self::INVALID_TOKENS as $token) {
            $this->assertFalse($parenthesisAuthToken->isValid($token));
        }
    }
}
