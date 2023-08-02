<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NewsFilter extends BaseFilter
{

    public function search(string $search): void
    {
        $this->builder->where('title', 'ILIKE', "%$search%");
    }

    public function source(string $sourceName): void
    {
        $this->builder->whereHas('author', function (Builder $builder) use ($sourceName) {
           $builder->whereHas('source', function (Builder $authorBuilder) use ($sourceName) {
              $authorBuilder->where('name', 'ILIKE', "%$sourceName%");
           });
        });
    }

    public function date(string $date): void
    {
        $this->builder->whereDate('published_at', '>', $date);
    }

    public function author(string $authorName): void
    {
        $this->builder->whereHas('author', function (Builder $builder) use ($authorName) {
           $builder->where('name', 'ILIKE', "%$authorName%");
        });
    }
}
