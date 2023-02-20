<?php

namespace Tests\Feature\version\v1\Api;

use Illuminate\Http\Response;
use Tests\ApiBaseTestCase;

class ShortUrlTest extends ApiBaseTestCase
{
    protected const TEST_ROUTE = '/api/v1/short-urls';
    protected const TEST_INVALID_VERSION_ROUTE = '/api/v0/short-urls';

    public function test_shorten_success(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::VALID_TOKEN,
        ])->postJson(self::TEST_ROUTE, ['url' => self::TEST_URL]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(self::RESPONSE_VALID_JSON_STRUCTURE);
    }

    public function test_shorten_no_url_parameter(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::VALID_TOKEN,
        ])->postJson(self::TEST_ROUTE);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(self::RESPONSE_INVALID_JSON_STRUCTURE);
    }

    public function test_shorten_url_parameter_not_valid(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::VALID_TOKEN,
        ])->postJson(self::TEST_ROUTE, ['url' => 5]);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(self::RESPONSE_INVALID_JSON_STRUCTURE);
    }

    public function test_shorten_invalid_route(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . self::VALID_TOKEN,
        ])->postJson(self::TEST_INVALID_VERSION_ROUTE, ['url' => self::TEST_URL, 'testVersion' => 'v0']);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
