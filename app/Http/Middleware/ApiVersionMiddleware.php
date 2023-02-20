<?php

namespace App\Http\Middleware;

use App\Traits\AnswersJsonRequests;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class ApiVersionMiddleware
{
    use AnswersJsonRequests;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $apiVersion = $request->route('version');
        $supportedApiVersions = Config::get('api.supported_versions');
        $versionIsSupported = in_array($apiVersion, $supportedApiVersions);

        if (!$versionIsSupported) {
            return $this->jsonResponse([], Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
