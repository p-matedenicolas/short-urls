<?php

use App\Http\Controllers\Api\ShortUrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// TODO explain advantages of subdomain over route parameter
Route::group(['prefix' => 'v1'], function () {
    Route::post('short-urls', [ShortUrlController::class, 'shortenUrl']);
});
