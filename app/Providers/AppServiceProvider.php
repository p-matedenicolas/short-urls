<?php

namespace App\Providers;

use App\Auth\Token\AuthToken;
use App\Auth\Token\ParenthesisAuthToken;
use App\Repositories\ShortUrl\ShortUrlRepository;
use App\Repositories\ShortUrl\TinyUrlRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShortUrlRepository::class, TinyUrlRepository::class);
        $this->app->bind(AuthToken::class, ParenthesisAuthToken::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
