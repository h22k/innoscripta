<?php

namespace App\Components\News\Clients;

use App\Components\News\Helpers\PoolOption;
use App\Components\News\PoolClient;
use Illuminate\Support\Arr;

class NewsApiClient extends BaseNewsClient
{

    use PoolClient;

    protected const SOURCES_URL = '/top-headlines/sources';

    public const NEWS_API_SOURCES_CACHE_KEY = 'news_api_sources';

    protected const MAX_SOURCES_LIMIT = 20;

    /**
     * @return array
     */
    protected function getResponse(): array
    {
        return $this->poolResponse([
            'queryParams' => [
                'sources' => $this->getNewsApiSources(),
                'page'    => 1
            ]
        ], new PoolOption('queryParams.page', finishIndex: self::MAX_SOURCES_LIMIT));
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return $this->extractPoolNews($news, 'articles');
    }

    /**
     * @return string
     */
    private function getNewsApiSources(): string
    {
        $sourcesFromNewsApi = \Cache::remember(self::NEWS_API_SOURCES_CACHE_KEY, 3600, function () {
            return $this->request->get(self::SOURCES_URL)->json();
        });

        $sourcesFilteredByLanguage = array_filter(Arr::get($sourcesFromNewsApi, 'sources', []), function ($source) {
            return Arr::get($source, 'language') === 'en';
        });

        return implode(',', array_slice(\Arr::pluck($sourcesFilteredByLanguage, 'id'), 0, self::MAX_SOURCES_LIMIT));
    }

    /**
     * @return string
     */
    protected function getNewsUri(): string
    {
        return '/everything';
    }
}
