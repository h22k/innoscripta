<?php

namespace App\Components\News\Processors;

use App\Components\News\Converters\NewsConvertable;
use App\Models\News;

class NewsProcessor implements NewsProcessable
{

    private array $convertedNews;

    public function __construct(readonly NewsConvertable $converter, readonly array $news)
    {
        $this->convertedNews = $converter->convert($news);
    }

    /**
     * @return News[]
     */
    public function process(): array
    {
        $news = [];

        foreach ($this->convertedNews as $convertedNewsValue) {
            if ( ! News::whereTitle($convertedNewsValue['title'])->exists()) {
                $news[] = News::create($convertedNewsValue);
            }
        }

        return $news;
    }
}
