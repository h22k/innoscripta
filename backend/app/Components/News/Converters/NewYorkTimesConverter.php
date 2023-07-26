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
            'title'        => 'headline.main',
            'description'  => 'lead_paragraph',
            'published_at' => 'pub_date',
            'url'          => 'web_url',
            'content'      => 'lead_paragraph',
        ];
    }
}
