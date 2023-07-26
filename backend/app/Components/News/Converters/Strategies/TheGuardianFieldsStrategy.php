<?php

namespace App\Components\News\Converters\Strategies;

use App\Components\News\Converters\Strategies\Contracts\AuthorStrategy;
use App\Components\News\Converters\Strategies\Contracts\CategoryStrategy;
use App\Components\News\Converters\Strategies\Contracts\SourceStrategy;
use Throwable;

class TheGuardianFieldsStrategy extends BaseFieldStrategy implements AuthorStrategy, CategoryStrategy, SourceStrategy
{

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareAuthor(array $news): array
    {
        return $this->getAuthorFields($news, '{The Guardian}', '{The Guardian}');
    }

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareCategory(array $news): array
    {
        return $this->getCategoryFields($news, 'pillarName');
    }

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareSource(array $news): array
    {
        return $this->getSourceFields($news, '{The Guardian}');
    }
}
