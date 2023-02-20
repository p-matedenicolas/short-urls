<?php

namespace Tests\Unit\version\v1\Repositories\ShortUrl;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Version\v1\app\Exceptions\TinyUrl\RequestException;
use Version\v1\app\Repositories\ShortUrl\TinyUrlRepository;

class TinyUrlTest extends TestCase
{
    public function test_no_auth(): void
    {
        $this->expectException(RequestException::class);

        Config::set('tinyurl.common.key', '');

        $tinyUrlRepository = new TinyUrlRepository();
        $tinyUrlRepository->shorten('https://google.es');
    }
}
