<?php

use App\Components\News\Enums\NewsSources;

return [
    'available_sources' => NewsSources::values(),

    'sources' => [

        NewsSources::NEW_YORK_TIMES->value => [
            'method_name' => 'newYorkTimes',
            'base_url'    => 'https://api.nytimes.com',
            'query_params'  => [
                'api-key' => env('NEW_YORK_TIMES_API_KEY'),
            ],
        ],

        NewsSources::NEWS_API->value => [
            'method_name' => 'newsApi',
            'base_url'    => 'https://newsapi.org/v2',
            'query_params'  => [
                'apiKey' => env('NEWSAPI_API_KEY'),
            ],
        ],

        NewsSources::THE_GUARDIAN->value => [
            'method_name' => 'theGuardian',
            'base_url'    => 'https://content.guardianapis.com',
            'query_params'  => [
                'api-key' => env('THE_GUARDIAN_API_KEY'),
            ],
        ],

    ],
];
