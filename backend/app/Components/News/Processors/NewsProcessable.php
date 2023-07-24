<?php

namespace App\Components\News\Processors;

use App\Components\News\Converters\NewsConvertable;
use App\Models\News;

interface NewsProcessable
{
    public function process(NewsConvertable $convertable): News;
}
