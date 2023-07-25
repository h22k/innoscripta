<?php

namespace App\Components\News\Clients;

use App\Components\News\Helpers\PoolOption;
use App\Components\News\PoolClient;
use Throwable;

class TheGuardianClient extends BaseNewsClient
{
    use PoolClient;

    const MAX_PAGE_COUNT = 10;

    /**
     * @return array
     * @throws Throwable
     */
    protected function getResponse(): array
    {
        return $this->poolResponse([
            'queryParams' => [
                'page' => 1
            ]
        ], new PoolOption('queryParams.page', finishIndex: self::MAX_PAGE_COUNT));
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return $this->extractPoolNews($news, 'response.results');
    }

    /**
     * @return string
     */
    protected function getNewsUri(): string
    {
        return '/search';
    }
}
