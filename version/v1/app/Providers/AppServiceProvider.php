<?php

namespace Version\v1\app\Providers;

use Illuminate\Support\ServiceProvider;
use Version\v1\app\Auth\Token\AuthToken;
use Version\v1\app\Auth\Token\ParenthesisAuthToken;
use Version\v1\app\Repositories\ShortUrl\ShortUrlRepository;
use Version\v1\app\Repositories\ShortUrl\TinyUrlRepository;

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
