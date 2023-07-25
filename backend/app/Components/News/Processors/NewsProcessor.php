<?php

namespace App\Components\News\Processors;

use App\Models\News;

class NewsProcessor implements NewsProcessable
{

    /**
     * @param  array  $convertedNews
     * @return News[]
     */
    public function process(array $convertedNews): array
    {
        $news = [];

        foreach ($convertedNews as $convertedNewsValue) {
            if ( ! News::whereTitle($convertedNewsValue['title'])->exists()) {
                $news[] = News::create($convertedNewsValue);
            }
        }

        return $news;
    }
}
