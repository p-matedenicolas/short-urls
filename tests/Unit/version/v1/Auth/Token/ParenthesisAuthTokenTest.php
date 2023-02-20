<?php

namespace Tests\Unit\version\v1\Auth\Token;

use PHPUnit\Framework\TestCase;
use Version\v1\app\Auth\Token\ParenthesisAuthToken;

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
