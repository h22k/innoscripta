<?php

namespace App\Jobs;

use App\Jobs\Helpers\NewsFetcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchNewsApiNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, NewsFetcher;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }
}
