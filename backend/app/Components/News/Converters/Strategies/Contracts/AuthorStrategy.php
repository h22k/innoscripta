<?php

namespace App\Components\News\Converters\Strategies\Contracts;

interface AuthorStrategy
{
    /**
     * @param  array  $news
     * @return array
     */
    public function prepareAuthor(array $news): array;
}
