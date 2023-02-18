<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\ApiBaseTestCase;

class AuthTest extends ApiBaseTestCase
{
    public function test_no_header(): void
    {
        $response = $this->postJson(self::TEST_ROUTE, ['url' => self::TEST_URL]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(self::RESPONSE_INVALID_TOKEN);
    }

    public function test_no_token(): void
    {
        $response = $this->withHeaders([
            'Authorization' => '',
        ])->postJson(self::TEST_ROUTE, ['url' => self::TEST_URL]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(self::RESPONSE_INVALID_TOKEN);
    }

    public function test_only_bearer(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer',
        ])->postJson(self::TEST_ROUTE, ['url' => self::TEST_URL]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson(self::RESPONSE_INVALID_TOKEN);
    }

    public function test_only_bearer_and_space(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ',
        ])->postJson(self::TEST_ROUTE, ['url' => self::TEST_URL]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(self::RESPONSE_VALID_JSON_STRUCTURE);
    }
}
