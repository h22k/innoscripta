<?php

namespace App\Components\News\Enums;

use App\Helper\EnumToArray;

enum NewsSources: string
{
    use EnumToArray;

    case NEW_YORK_TIMES = 'new_york_times';

    case NEWS_API = 'news_api';

    case THE_GUARDIAN = 'the_guardian';
}
