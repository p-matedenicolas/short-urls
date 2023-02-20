<?php

namespace Version\v1\app\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Version\v1\app\Http\Requests\ShortenUrlRequest;
use Version\v1\app\Repositories\ShortUrl\ShortUrlRepository;

class ShortUrlController extends ApiController
{
    /**
     * @var ShortUrlRepository
     */
    protected ShortUrlRepository $shortUrlRepository;

    /**
     * @param ShortUrlRepository $shortUrlRepository
     */
    public function __construct(ShortUrlRepository $shortUrlRepository)
    {
        $this->shortUrlRepository = $shortUrlRepository;
    }

    /**
     * @param ShortenUrlRequest $request
     * @return JsonResponse
     */
    public function shortenUrl(ShortenUrlRequest $request): JsonResponse
    {
        $requestUrl = $request->input('url');

        $responseUrl = $this->shortUrlRepository->shorten($requestUrl);

        return $this->jsonResponse([
            'url' => $responseUrl
        ]);
    }
}
