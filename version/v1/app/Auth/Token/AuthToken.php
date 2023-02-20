<?php

namespace Version\v1\app\Auth\Token;

interface AuthToken
{
    public function isValid(string $token): bool;
}
