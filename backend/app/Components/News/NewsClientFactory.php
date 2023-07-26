<?php

namespace App\Components\News;

use App\Components\News\Clients\NewsApiClient;
use App\Components\News\Clients\NewsHTTPClient;
use App\Components\News\Clients\NewYorkTimesClient;
use App\Components\News\Clients\TheGuardianClient;
use App\Components\News\Enums\NewsSources;
use App\Components\News\Helpers\ChecksNewsSource;
use App\Exceptions\InvalidNewsSourceException;
use Illuminate\Http\Client\PendingRequest;

class NewsClientFactory
{
    use ChecksNewsSource;

    /**
     * @param  string  $source
     * @return NewsHTTPClient
     * @throws InvalidNewsSourceException
     */
    public static function getClient(string $source): NewsHTTPClient
    {
        self::checkSource($source);

        return match ($source) {
            NewsSources::NEW_YORK_TIMES->value => new NewYorkTimesClient(\Http::newYorkTimes()),
            NewsSources::NEWS_API->value       => new NewsApiClient(\Http::newsApi()),
            NewsSources::THE_GUARDIAN->value   => new TheGuardianClient(\Http::theGuardian()),
        };
    }

}
