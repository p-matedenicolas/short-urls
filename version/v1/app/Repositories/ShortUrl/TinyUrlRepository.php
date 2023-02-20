<?php

namespace Version\v1\app\Repositories\ShortUrl;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Version\v1\app\Exceptions\TinyUrl\RequestException;

class TinyUrlRepository implements ShortUrlRepository
{
    protected const ENDPOINT_CREATE = 'create';

    /**
     * @param string $url
     * @return string
     * @throws RequestException
     */
    public function shorten(string $url): string
    {
        $createUrl = $this->getUrl(self::ENDPOINT_CREATE);

        $createBody = [
            'url' => $url
        ];

        $createResponse = $this->getHttpClient()->post($createUrl, $createBody);

        return $this->processResponse($createResponse);
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => Config::get('tinyurl.common.key'),
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * @return PendingRequest
     */
    protected function getHttpClient(): PendingRequest
    {
        return Http::withHeaders($this->getHeaders());
    }

    /**
     * @param string|null $endpoint
     * @return string
     */
    protected function getUrl(string $endpoint = null): string
    {
        return Config::get('tinyurl.common.url') . $endpoint;
    }

    /**
     * @param $response
     * @return mixed
     * @throws RequestException
     */
    protected function processResponse($response): mixed
    {
        if ($response->status() !== Response::HTTP_OK) {
            Log::error($response);
            throw new RequestException('TinyUrl request not successful');
        }

        $responseData = $response->json();

        return $responseData['data']['tiny_url'];
    }
}
