<?php

namespace App\Components\News\Clients;

use App\Components\News\Helpers\PoolOption;
use Illuminate\Support\Arr;
use Throwable;

class TheGuardianClient extends BaseNewsClient
{
    const MAX_PAGE_COUNT = 10;

    /**
     * @return array
     * @throws Throwable
     */
    protected function getResponse(): array
    {
        $pageStart = 1;
        $responses = $this->getNewsFromSourceWithPool([
            'queryParams' => [
                'page' => $pageStart
            ]
        ], new PoolOption('queryParams.page', 1, self::MAX_PAGE_COUNT));

        $results = [];

        foreach ($responses as $response) {
            $results[] = $response->json();
        }

        return $results;
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return Arr::collapse(\Arr::pluck($news, 'response.results'));
    }

    /**
     * @return string
     */
    protected function getNewsUri(): string
    {
        return '/search';
    }
}
