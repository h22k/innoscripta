<?php

namespace App\Components\News\Clients;

use App\Components\News\Helpers\PoolOption;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Throwable;
use Illuminate\Support\Facades\Http;

abstract class BaseNewsClient implements NewsHTTPClient
{
    public function __construct(protected PendingRequest $request)
    {
    }

    /**
     * @return array
     */
    abstract protected function getResponse(): array;

    /**
     * @param  array  $news
     * @return array
     */
    abstract protected function extractNews(array $news): array;

    abstract protected function getNewsUri(): string;

    /**
     * @param  array  $options
     * @return array
     * @throws Throwable
     */
    protected function getNewsFromSource(array $options = []): array
    {
        $response = $this->prepareRequest($this->request, $options);

        throw_if($response->failed(),
            new HttpClientException(sprintf('Response failed! |||| ERROR_JSON::: %s',
                json_encode([$response->body(), $response->status(), $response->effectiveUri()]))));

        return $response->json();
    }

    /**
     * @param  array  $options
     * @param  PoolOption  $poolOption
     * @return array<PromiseInterface | Response>
     */
    protected function getNewsFromSourceWithPool(array $options, PoolOption $poolOption): array
    {
        /**
         * @var array<PromiseInterface | Response> $responses
         */
        $responses = Http::pool(function (Pool $pool) use ($options, $poolOption) {
            for ($i = $poolOption->getStartIndex(); $i <= $poolOption->getFinishIndex(); $i++) {
                \Arr::set($options, $poolOption->getIncreasedKey(), $i);
                $requests[] = $this->prepareRequest($pool, $options);
            }
            return $requests ?? [];
        });

        return $responses;
    }

    /**
     * @param  PendingRequest|Pool  $request
     * @param  array  $options
     * @return Response | PromiseInterface
     */
    protected function prepareRequest(PendingRequest | Pool $request, array $options): Response | PromiseInterface
    {
        if ($request instanceof Pool) {
            $requestOptions = $this->request->getOptions();
            $request = $request
                ->baseUrl(\Arr::get($requestOptions, 'base_url'))
                ->withQueryParameters(\Arr::get($requestOptions, 'query_params'));
        }
        return $request
            ->withUrlParameters(\Arr::get($options, 'urlParams', []))
            ->withQueryParameters(\Arr::get($options, 'queryParams', []))
            ->get($this->getNewsUri());
    }

    /**
     * @return array
     * @throws Throwable
     */
    public function getNews(): array
    {
        $response = $this->getResponse();

        return $this->extractNews($response);
    }
}
