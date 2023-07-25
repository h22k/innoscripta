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
            'source'       => '{The Guardian}', // {} means it's default value, so in this case the source always will be The Guardian
            'title'        => 'webTitle',
            'description'  => 'webTitle',
            'author'       => '{The Guardian}',
            'published_at' => 'webPublicationDate',
            'url'          => 'webUrl',
            'content'      => 'webTitle',
        ];
    }
}
