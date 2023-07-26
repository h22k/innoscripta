<?php

namespace App\Components\News\Processors;

use App\Models\News;

interface NewsProcessable
{
    /**
     * @return array<News>
     */
    public function process(): array;
}
