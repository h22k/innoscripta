<?php

namespace App\Components\News;

use App\Components\News\Clients\NewsHTTPClient;
use App\Components\News\Converters\NewsConvertable;
use App\Components\News\Processors\NewsProcessable;
use App\Components\News\Processors\NewsProcessor;

readonly class NewsContext
{

    public function __construct(
        private NewsHTTPClient $client,
        private NewsConvertable $converter,
    ) {
    }

    /**
     * @return NewsProcessable
     */
    public function fetchNews(): NewsProcessable
    {
        return new NewsProcessor($this->converter, $this->client->getNews());
    }

}
