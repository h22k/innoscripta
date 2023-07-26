<?php

namespace App\Components\News\Helpers;

use App\Exceptions\InvalidNewsSourceException;

trait ChecksNewsSource
{
    /**
     * @param  string  $source
     * @return void
     * @throws InvalidNewsSourceException
     */
    private static function checkSource(string $source): void
    {
        $availableSources = config('news.sources');

        if ( ! array_key_exists($source, $availableSources)) {
            throw new InvalidNewsSourceException($source);
        }
    }

}
