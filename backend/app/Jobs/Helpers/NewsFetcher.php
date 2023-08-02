<?php

namespace App\Jobs\Helpers;

use App\Components\News\NewsContext;
use App\Models\News;

trait NewsFetcher
{

    /**
     * Execute the job.
     */
    public function handle(NewsContext $context, string $sourceName): void
    {
        $startTime = time();
        \Log::info("Started to fetch news from $sourceName");

        $startNewsCount = News::count();

        try {
            $context->fetchNews()->process();
        } catch (\Exception $exception) {
            \Log::info("something went wrong while processing $sourceName data |||| ". json_encode($exception));
        }

        $finishTime = time();
        $finishNewsCount = News::count();

        $timeDiff = $finishTime - $startTime;
        $countDiff = $finishNewsCount - $startNewsCount;

        \Log::info("Finished to fetch from $sourceName . It took $timeDiff s! Added $countDiff news!");
    }

}
