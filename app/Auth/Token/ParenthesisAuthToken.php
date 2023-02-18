<?php

namespace App\Auth\Token;


class ParenthesisAuthToken implements AuthToken
{
    protected const PARENTHESIS = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
    ];

    /**
     * @param string|null $token
     * @return bool
     */
    public function isValid(?string $token): bool
    {
        if ($token === null) {
            return false;
        }

        if ($token === '') {
            return true;
        }

        $tokenChars = str_split($token);
        $openCharsStack = [];

        foreach ($tokenChars as $currentChar) {
            if (isset(self::PARENTHESIS[$currentChar])) {
                $openCharsStack[] = $currentChar;
                continue;
            }

            if (empty($openCharsStack)) {
                return false;
            }

            $lastIndex = count($openCharsStack) - 1;
            $lastOpenChar = $openCharsStack[$lastIndex];


            if (self::PARENTHESIS[$lastOpenChar] === $currentChar) {
                array_splice($openCharsStack, $lastIndex, 1);
            } else {
                return false;
            }
        }

        return empty($openCharsStack);
    }
}
