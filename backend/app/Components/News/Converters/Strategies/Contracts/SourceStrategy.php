<?php

namespace App\Components\News\Converters\Strategies\Contracts;

interface SourceStrategy
{

    /**
     * @param  array  $news
     * @return array
     */
    public function prepareSource(array $news): array;

}
