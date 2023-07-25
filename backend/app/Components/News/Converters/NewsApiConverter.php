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
            'source'       => 'source.name',
            'title'        => 'title',
            'description'  => 'description',
            'author'       => 'author',
            'published_at' => 'publishedAt',
            'url'          => 'url',
            'content'      => 'content',
        ];
    }
}
