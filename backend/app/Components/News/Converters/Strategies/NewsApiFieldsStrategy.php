<?php

namespace App\Components\News\Converters\Strategies;

use App\Components\News\Converters\Strategies\Contracts\AuthorStrategy;
use App\Components\News\Converters\Strategies\Contracts\SourceStrategy;
use Throwable;

class NewsApiFieldsStrategy extends BaseFieldStrategy implements AuthorStrategy, SourceStrategy
{
    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareAuthor(array $news): array
    {
        return $this->getAuthorFields($news, 'author', 'source.name');
    }

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareSource(array $news): array
    {
        return $this->getSourceFields($news, 'source.name');
    }
}
