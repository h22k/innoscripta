<?php

namespace App\Components\News;

use App\Components\News\Helpers\PoolOption;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Throwable;

trait PoolClient
{

    /**
     * @param  array  $options
     * @param  PoolOption  $poolOption
     * @return array<PromiseInterface | Response>
     */
    protected function poolRequest(array $options, PoolOption $poolOption): array
    {
        return $this->getNewsFromSourceWithPool($options, $poolOption);
    }

    /**
     * @param  array  $options
     * @param  PoolOption  $poolOption
     * @return array
     * @throws Throwable
     */
    protected function poolResponse(array $options, PoolOption $poolOption): array
    {
        $responses = $this->poolRequest($options, $poolOption);

        $results = [];

        foreach ($responses as $response) {
            throw_if($response->failed(), \Exception::class, json_encode($response->body()));
            $results[] = $response->json();
        }

        return $results;
    }

    /**
     * @param  array  $news
     * @param  string  $field
     * @return array
     */
    protected function extractPoolNews(array $news, string $field): array
    {
        return Arr::collapse(\Arr::pluck($news, $field));
    }

}
