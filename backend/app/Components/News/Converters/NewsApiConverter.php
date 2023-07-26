<?php

namespace App\Components\News\Converters;

class NewsApiConverter extends BaseConverter
{

    /**
     * @return array
     */
    protected function getFieldMap(): array
    {
        return [
            'title'        => 'title',
            'description'  => 'description',
            'published_at' => 'publishedAt',
            'url'          => 'url',
            'content'      => 'content',
        ];
    }
}
