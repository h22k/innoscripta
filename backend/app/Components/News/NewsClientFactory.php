<?php

namespace App\Components\News;

use App\Components\News\Enums\NewsSources;
use App\Exceptions\InvalidNewsSourceException;
use Illuminate\Http\Client\PendingRequest;

class NewsClientFactory
{

    /**
     * @param  string  $source
     * @return PendingRequest
     * @throws InvalidNewsSourceException
     */
    public static function getClient(string $source): PendingRequest
    {
        $availableSources = config('news.available_sources');

        if ( ! in_array($source, $availableSources)) {
            throw new InvalidNewsSourceException($source);
        }

        return match ($source) {
            NewsSources::NEW_YORK_TIMES->value => \Http::newYorkTimes(),
            NewsSources::NEWS_API->value       => \Http::newsApi(),
            NewsSources::THE_GUARDIAN->value   => \Http::theGuardian(),
        };
    }

}
