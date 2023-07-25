<?php

namespace App\Components\News;

use App\Components\News\Clients\NewsHTTPClient;
use App\Components\News\Converters\NewsConvertable;
use App\Components\News\Processors\NewsProcessable;
use App\Models\News;

class NewsContext
{
    private array $news;

    public function __construct(
        private readonly NewsHTTPClient $client,
        private readonly NewsConvertable $convertor,
        private readonly NewsProcessable $processor,
    ) {
    }

    public function fetchNews(): NewsContext
    {
        $this->news = $this->client->getNews();

        return $this;
    }

    /**
     * @return array<News>
     */
    public function processNews(): array
    {
        $convertedNews = $this->convertor->convert($this->news);

        return $this->processor->process($convertedNews);
    }

}
