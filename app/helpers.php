<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

if (! function_exists('current_api_version')) {
    /**
     * @return string|null
     */
    function current_api_version(): ?string
    {
        $urlPath = parse_url(Request::url())['path'] ?? '';
        $apiVersion = explode('/', $urlPath)[2] ?? null;

        if ($apiVersion === null && App::runningInConsole()) {
            $apiVersion = Config::get('api.latest_version');
        }

        $supportedApiVersions = Config::get('api.supported_versions');
        $versionIsSupported = in_array($apiVersion, $supportedApiVersions);

        return $versionIsSupported ? $apiVersion : null;
    }
}

if (! function_exists('version_namespace')) {
    /**
     * @param $version
     * @param string $namespace
     * @return string
     */
    function version_namespace($version, string $namespace = ''): string
    {
        return 'Version\\' . $version . '\\' . $namespace;
    }
}

if (! function_exists('version_base_path')) {
    /**
     * @param $version
     * @param string $path
     * @return string
     */
    function version_base_path($version, string $path = ''): string
    {
        $path = 'version/' . $version . '/' . $path;

        return app()->basePath($path);
    }
}
