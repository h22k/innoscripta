<?php

namespace App\Components\News\Converters\Strategies;

use App\Components\News\Converters\Strategies\Contracts\AuthorStrategy;
use App\Components\News\Converters\Strategies\Contracts\CategoryStrategy;
use App\Components\News\Converters\Strategies\Contracts\SourceStrategy;
use Throwable;

class NewYorkTimesFieldsStrategy extends BaseFieldStrategy implements SourceStrategy, AuthorStrategy, CategoryStrategy
{

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareSource(array $news): array
    {
        return $this->getSourceFields($news, 'source');
    }


    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareAuthor(array $news): array
    {
        return $this->getAuthorFields($news, 'byline.original', 'source');
    }

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function prepareCategory(array $news): array
    {
        return $this->getCategoryFields($news, 'section_name');
    }
}
