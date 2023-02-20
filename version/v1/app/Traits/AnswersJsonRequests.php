<?php

namespace Version\v1\app\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Common method to send responses
 */
trait AnswersJsonRequests
{
    /**
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function jsonResponse(array $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        $jsonResponse = new JsonResponse();

        $jsonResponse->setStatusCode($statusCode);
        $jsonResponse->setEncodingOptions(JSON_UNESCAPED_SLASHES);
        $jsonResponse->setData($data);

        return $jsonResponse;
    }
}
