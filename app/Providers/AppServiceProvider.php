<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $apiAppServiceProvider = $this->getApiAppServiceProvider();
        $apiAppServiceProvider?->register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $apiAppServiceProvider = $this->getApiAppServiceProvider();
        $apiAppServiceProvider?->boot();
    }

    // TODO improvement: better in a factory class
    /**
     * @return ServiceProvider|null
     */
    protected function getApiAppServiceProvider(): ?ServiceProvider
    {
        $apiVersion = current_api_version();

        if (isset($apiVersion)) {
            $apiAppServiceProviderNamespace = version_namespace($apiVersion, 'app\\Providers\\AppServiceProvider');

            return new $apiAppServiceProviderNamespace($this->app);
        }

        return null;
    }

}
