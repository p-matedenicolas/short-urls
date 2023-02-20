<?php

use Illuminate\Support\Facades\Route;
use Version\v1\app\Http\Controllers\Api\ShortUrlController;
use Version\v1\app\Http\Middleware\AuthenticateToken;
use Version\v1\app\Http\Middleware\JsonHeaderMiddleware;

Route::middleware([
    JsonHeaderMiddleware::class,
    AuthenticateToken::class
])->group(function () {
    Route::post('short-urls', [ShortUrlController::class, 'shortenUrl']);
});
