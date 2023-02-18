<?php

namespace App\Repositories\ShortUrl;

interface ShortUrlRepository
{
    /**
     * @param string $url
     * @return string
     */
    public function shorten(string $url): string;
}
