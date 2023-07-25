<?php

namespace App\Components\News\Converters;

interface NewsConvertable
{
    public function convert(array $news): array;
}
