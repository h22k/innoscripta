<?php

namespace App\Components\News\Processors;

use App\Models\News;

interface NewsProcessable
{
    /**
     * @param  array  $convertedNews
     * @return array<News>
     */
    public function process(array $convertedNews): array;
}
