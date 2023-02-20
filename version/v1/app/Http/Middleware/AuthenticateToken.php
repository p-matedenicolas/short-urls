<?php

namespace Version\v1\app\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Version\v1\app\Auth\Token\AuthToken;
use Version\v1\app\Traits\AnswersJsonRequests;

class AuthenticateToken
{
    use AnswersJsonRequests;

    /**
     * @var AuthToken
     */
    protected AuthToken $authToken;

    /**
     * @param AuthToken $authToken
     */
    public function __construct(AuthToken $authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $bearerToken = $request->bearerToken();

        if (!$this->authToken->isValid($bearerToken)) {
            return $this->jsonResponse([
                'message' => 'No valid token'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
