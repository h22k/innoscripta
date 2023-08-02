<?php

namespace App\Models;

use App\Filters\Helper\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'published_at',
        'url',
        'content',
        'category_id'
    ];

    protected $appends = [
        'author_name',
        'source_name',
    ];

    protected $casts = [
        'published_at' => 'date'
    ];

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return Source
     */
    public function source(): Source
    {
        return $this->author->source;
    }

    /**
     * @return string
     */
    public function getSourceNameAttribute(): string
    {
        return $this->source()->name;
    }

    /**
     * @return string
     */
    public function getAuthorNameAttribute(): string
    {
        return $this->author->name;
    }
}
