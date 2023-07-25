<?php

namespace App\Components\News\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Throwable;

class NewYorkTimesClient extends BaseNewsClient
{
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
     * @return array
     * @throws Throwable
     */
    protected function getResponse(): array
    {
        return $this->getNewsFromSource([
            'urlParams' => $this->getUrlParameters()
        ]);
    }

    /**
     * @param  array  $news
     * @return array
     */
    protected function extractNews(array $news): array
    {
        return Arr::get($news, 'response.docs');
    }

    /**
     * @return string
     */
    protected function getNewsUri(): string
    {
        return '/svc/archive/v1/{year}/{month}.json';
    }
}
