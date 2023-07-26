<?php

namespace App\Components\News\Converters;

class TheGuardianConverter extends BaseConverter
{

    /**
     * @return array
     */
    protected function getFieldMap(): array
    {
        return [
            'title'        => 'webTitle',
            'description'  => 'webTitle',
            'published_at' => 'webPublicationDate',
            'url'          => 'webUrl',
            'content'      => 'webTitle',
        ];
    }
}
