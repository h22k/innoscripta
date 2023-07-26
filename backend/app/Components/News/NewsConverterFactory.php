<?php

namespace App\Components\News;

use App\Components\News\Converters\NewsApiConverter;
use App\Components\News\Converters\NewsConvertable;
use App\Components\News\Converters\NewYorkTimesConverter;
use App\Components\News\Converters\Strategies\NewsApiFieldsStrategy;
use App\Components\News\Converters\Strategies\NewYorkTimesFieldsStrategy;
use App\Components\News\Converters\Strategies\TheGuardianFieldsStrategy;
use App\Components\News\Converters\TheGuardianConverter;
use App\Components\News\Enums\NewsSources;
use App\Components\News\Helpers\ChecksNewsSource;
use App\Exceptions\InvalidNewsSourceException;

class NewsConverterFactory
{
    use ChecksNewsSource;
    /**
     * @param  string  $source
     * @return NewsConvertable
     * @throws InvalidNewsSourceException
     */
    public static function getConverter(string $source): NewsConvertable
    {
        self::checkSource($source);

        return match ($source) {
            NewsSources::NEW_YORK_TIMES->value => new NewYorkTimesConverter(new NewYorkTimesFieldsStrategy),
            NewsSources::NEWS_API->value       => new NewsApiConverter(new NewsApiFieldsStrategy),
            NewsSources::THE_GUARDIAN->value   => new TheGuardianConverter(new TheGuardianFieldsStrategy),
        };
    }

}
