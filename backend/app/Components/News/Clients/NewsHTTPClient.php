<?php

namespace App\Components\News\Clients;

use Illuminate\Http\Client\Response;

interface NewsHTTPClient
{
    /**
     * get all news from source
     *
     * @return array
     */
    public function getNews(): array;
}
