<?php

namespace App\Components\News\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;

class NewYorkTimesClient extends BaseNewsClient
{

    protected const NEWS_URL = '/svc/archive/v1/{year}/{month}.json';

    /**
     * @return array
     */
    private function getUrlParameters(): array
    {
        return [
            'year'  => now()->year,
            'month' => now()->month
        ];
    }

    /**
     * @return Response
     */
    protected function getResponse(): Response
    {
        return $this->request->withUrlParameters($this->getUrlParameters())->get(self::NEWS_URL);
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return Arr::get($news, 'response.docs');
    }
}
