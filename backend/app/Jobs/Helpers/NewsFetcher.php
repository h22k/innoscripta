<?php

namespace App\Jobs\Helpers;

use App\Components\News\NewsContext;

trait NewsFetcher
{

    /**
     * Execute the job.
     */
    public function handle(NewsContext $context, string $sourceName): void
    {
        $startTime = time();
        \Log::info("Started to fetch news from $sourceName");

        $context->fetchNews()->process();

        $finishTime = time();

        $diff = $finishTime - $startTime;

        \Log::info("Finished to fetch. It took $diff s!");
    }

}
