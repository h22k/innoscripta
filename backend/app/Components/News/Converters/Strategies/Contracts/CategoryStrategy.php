<?php

namespace App\Components\News\Converters\Strategies\Contracts;

interface CategoryStrategy
{
    /**
     * @param  array  $news
     * @return array
     */
    public function prepareCategory(array $news): array;
}
