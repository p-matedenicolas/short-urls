<?php

namespace Tests\Unit\app\Providers;

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class ApiAppServiceProviderTest extends TestCase
{
    public function test_not_api_request(): void
    {
        Config::set('api.latest_version', '');

        $appServiceProvider = new AppServiceProvider(app());
        $appServiceProvider->register();
        $appServiceProvider->boot();

        // no exception thrown
        $this->assertTrue(true);
    }
}
