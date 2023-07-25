<?php

namespace App\Providers;

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

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    private function addMacrosToHttp(array $sources): void
    {
        foreach ($sources as $source) {
            \Http::macro($source['method_name'], fn () => \Http::baseUrl($source['base_url'])->withQueryParameters($source['url_params'])->withOptions($source));
        }
    }
}
