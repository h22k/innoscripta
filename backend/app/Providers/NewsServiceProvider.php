<?php

namespace App\Providers;

use App\Components\News\NewsClientFactory;
use App\Components\News\NewsContext;
use App\Components\News\NewsConverterFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $sources = config('news.sources');

        $this->addMacrosToHttp($sources);
        $this->bindJobMethods($sources);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    private function bindJobMethods(array $sources)
    {
        foreach ($sources as $sourceKey => $source) {
            $this->app->bindMethod([\Arr::get($source, 'job'), 'handle'], function ($job, Application $application) use ($sourceKey) {
                $client = NewsClientFactory::getClient($sourceKey);
                $converter = NewsConverterFactory::getConverter($sourceKey);

                return $job->handle(new NewsContext($client, $converter), $sourceKey);
            });
        }
    }

    private function addMacrosToHttp(array $sources): void
    {
        foreach ($sources as $source) {
            \Http::macro($source['method_name'], fn () => \Http::baseUrl($source['base_url'])->withQueryParameters($source['query_params'])->withOptions($source));
        }
    }
}
