<?php

use Illuminate\Support\Facades\Route;
use Version\v1\app\Http\Controllers\Api\ShortUrlController;
use Version\v1\app\Http\Middleware\AuthenticateTokenMiddleware;

Route::middleware([
    AuthenticateTokenMiddleware::class
])->group(function () {
    Route::post('short-urls', [ShortUrlController::class, 'shortenUrl']);
});
