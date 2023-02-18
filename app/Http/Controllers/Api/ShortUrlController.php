<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ShortenUrlRequest;
use App\Repositories\ShortUrl\ShortUrlRepository;
use Illuminate\Http\JsonResponse;

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
