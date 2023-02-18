<?php

namespace App\Auth\Token;

interface AuthToken
{
    public function isValid(string $token): bool;
}
