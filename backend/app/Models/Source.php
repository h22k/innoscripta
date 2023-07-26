<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Source extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }

    /**
     * @return HasManyThrough
     */
    public function articles(): HasManyThrough
    {
        return $this->hasManyThrough(News::class, Author::class);
    }
}
