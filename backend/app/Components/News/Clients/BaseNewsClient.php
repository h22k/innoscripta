<?php

namespace App\Components\News\Clients;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Throwable;

abstract class BaseNewsClient implements NewsHTTPClient
{
    public function __construct(protected PendingRequest $request) {}

    /**
     * @return Response
     */
    abstract protected function getResponse(): Response;

    /**
     * @param  array  $news
     * @return array
     */
    abstract protected function extractNews(array $news): array;

    /**
     * @return array
     * @throws Throwable
     */
    public function getNews(): array
    {
        $response = $this->getResponse();

        throw_if($response->failed(), new HttpClientException(sprintf('Response failed! |||| ERROR_JSON::: %s', json_encode($response))));

        return $this->extractNews($response->json());
    }
}
