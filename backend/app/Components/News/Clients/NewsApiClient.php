<?php

namespace App\Components\News\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;

class NewsApiClient extends BaseNewsClient
{

    protected const NEWS_URL = '/everything';

    protected const SOURCES_URL = '/top-headlines/sources';

    public const NEWS_API_SOURCES_CACHE_KEY = 'news_api_sources';

    protected const MAX_SOURCES_LIMIT = 20;

    /**
     * @return Response
     */
    protected function getResponse(): Response
    {
        $sources = $this->getNewsApiSources();

        return $this->request->withQueryParameters(compact('sources'))->get(self::NEWS_URL);
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return Arr::get($news, 'articles');
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
}
