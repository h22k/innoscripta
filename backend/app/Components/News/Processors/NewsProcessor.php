<?php

namespace App\Components\News\Processors;

use App\Components\News\Converters\NewsConvertable;
use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Illuminate\Database\Eloquent\Model;

class NewsProcessor implements NewsProcessable
{

    private array $convertedNews;

    public function __construct(readonly NewsConvertable $converter, readonly array $news)
    {
        $this->convertedNews = $converter->convert($news);
    }

    /**
     * @param  array  $fields
     * @param  string  $modelNameSpace
     * @return Model
     */
    private function getModel(array $fields, string $modelNameSpace): Model
    {
        return $modelNameSpace::where($fields)->firstOrCreate($fields);
    }

    /**
     * @param  array  $fields
     * @return Author | Model
     */
    private function getAuthor(array $fields): Author | Model
    {
        return $this->getModel($fields, Author::class);
    }

    /**
     * @param  array  $fields
     * @return Source|Model
     */
    private function getSource(array $fields): Source | Model
    {
        return $this->getModel($fields, Source::class);
    }

    /**
     * @param  array  $fields
     * @return Category|Model|null
     */
    private function getCategory(array $fields): Category | Model | null
    {
        return count($fields) === 0 ? null : $this->getModel($fields, Category::class);
    }

    /**
     * @return News[]
     */
    public function process(): array
    {
        $news = [];

        foreach ($this->convertedNews as $convertedNewsValue) {
            if ( ! News::whereTitle($convertedNewsValue['title'])->exists()) {
                $meta = \Arr::get($convertedNewsValue, 'meta');

                $source = $this->getSource(\Arr::get($meta, 'source'));
                $author = $this->getAuthor(array_merge(\Arr::get($meta, 'author'), ['source_id' => $source->id]));
                $category = $this->getCategory(\Arr::get($meta, 'category') ?? []);

                if ($category) {
                    $convertedNewsValue['category_id'] = $category->id;
                }

                $news[] = $author->articles()->create($convertedNewsValue);
            }
        }

        return $news;
    }
}
