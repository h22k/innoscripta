<?php

namespace App\Components\News\Converters;

use App\Components\News\Converters\Strategies\Contracts\AuthorStrategy;
use App\Components\News\Converters\Strategies\Contracts\CategoryStrategy;
use App\Components\News\Converters\Strategies\Contracts\SourceStrategy;
use App\Components\News\Helpers\DefaultValue;
use App\Models\News;
use Throwable;

abstract class BaseConverter implements NewsConvertable
{
    use DefaultValue;

    public function __construct(private readonly AuthorStrategy|CategoryStrategy|SourceStrategy $strategy)
    {
    }

    abstract protected function getFieldMap(): array;

    /**
     * @return array
     */
    private function getFillableFieldsFromNewsModel(): array
    {
        return array_filter((new News)->getFillable(), function ($key) {
            return ! \Str::endsWith($key, '_id');
        });
    }

    /**
     * @return array
     * @throws Throwable
     */
    private function getFieldMapWithCondition(): array
    {
        $fieldMap = $this->getFieldMap();

        throw_unless(
            count($fieldMap) === count($newsFillable = $this->getFillableFieldsFromNewsModel()),
            new \InvalidArgumentException('There is an error about converter.')
        );

        foreach ($fieldMap as $modelField => $apiField) {
            throw_unless(
                in_array($modelField, $newsFillable),
                new \InvalidArgumentException('There is an error about converter.')
            );
        }

        return $fieldMap;
    }

    /**
     * @param  array  $convertedNews
     * @param  array  $singleNews
     * @return void
     */
    private function setNewsMeta(array &$convertedNews, array $singleNews): void
    {
        if ($this->strategy instanceof SourceStrategy) {
            $convertedNews['meta']['source'] = $this->strategy->prepareSource($singleNews);
        }
        if ($this->strategy instanceof AuthorStrategy) {
            $convertedNews['meta']['author'] = $this->strategy->prepareAuthor($singleNews);
        }
        if ($this->strategy instanceof CategoryStrategy) {
            $convertedNews['meta']['category'] = $this->strategy->prepareCategory($singleNews);
        }
    }

    /**
     * @param  array  $news
     * @return array
     * @throws Throwable
     */
    public function convert(array $news): array
    {
        $fieldMap = $this->getFieldMapWithCondition();

        return \Arr::map($news, function ($singleNews) use ($fieldMap) {

            $converted = [];

            foreach ($fieldMap as $modelField => $apiField) {
                $value = $this->isDefaultValue($apiField)
                    ? $this->getValueWithoutBrackets($apiField)
                    : \Arr::get($singleNews, $apiField);

                $converted[$modelField] = $value;
                $this->setNewsMeta($converted, $singleNews);
            }

            return $converted;
        });
    }
}
