<?php

namespace Tests\Unit\Repositories\ShortUrl;

use App\Exceptions\TinyUrl\RequestException;
use App\Repositories\ShortUrl\TinyUrlRepository;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class TinyUrlTest extends TestCase
{
    public function test_no_auth(): void
    {
        $this->expectException(RequestException::class);

        Config::set('tinyurl.key', '');

        $tinyUrlRepository = new TinyUrlRepository();
        $tinyUrlRepository->shorten('https://google.es');
    }
}
