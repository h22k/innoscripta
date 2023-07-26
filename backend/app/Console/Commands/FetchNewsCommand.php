<?php

namespace App\Console\Commands;

use App\Components\News\NewsClientFactory;
use App\Components\News\NewsContext;
use App\Components\News\NewsConverterFactory;
use App\Exceptions\InvalidNewsSourceException;
use App\Jobs\FetchNewsJob;
use Illuminate\Console\Command;

class FetchNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news';

    /**
     * Execute the console command.
     * @throws InvalidNewsSourceException
     */
    public function handle(): void
    {
        $availableSources = config('news.sources');

        foreach ($availableSources as $availableSource => $config) {
            $job = \Arr::get($config, 'job');

            $this->info("Fetching news from $availableSource has been added queue ");
            $job::dispatch();
        }
    }
}
