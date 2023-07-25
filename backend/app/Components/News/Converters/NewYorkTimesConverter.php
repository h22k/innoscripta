<?php

namespace App\Components\News\Converters;

use App\Models\News;

class NewYorkTimesConverter extends BaseConverter
{
    /**
     * @return array
     */
    protected function getFieldMap(): array
    {
        return [
            'source'       => 'source',
            'title'        => 'headline.main',
            'description'  => 'lead_paragraph',
            'author'       => 'byline.original',
            'published_at' => 'pub_date',
            'url'          => 'web_url',
            'content'      => 'lead_paragraph',
        ];
    }
}
