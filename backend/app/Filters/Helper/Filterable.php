<?php

namespace App\Filters\Helper;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    /**
     * @param $query
     * @param  BaseFilter  $filter
     * @return Builder
     */
    public function scopeFilter($query, BaseFilter $filter): Builder
    {
        return $filter->apply($query);
    }

}
