<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BaseFilter
{

    protected Builder $builder;

    public function __construct(protected readonly Request $request)
    {
    }


    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        $filters = $this->filters();

        foreach ($filters as $field => $value) {
            if ( ! method_exists($this, $field) || strlen($value) < 1) {
                continue;
            }

            $this->$field($value);
        }

        return $this->builder;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->request->query();
    }
}
