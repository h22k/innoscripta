<?php

namespace App\Components\News\Converters\Strategies;

use App\Components\News\Helpers\DefaultValue;
use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use Throwable;

class BaseFieldStrategy
{
    use DefaultValue;

    /**
     * @param  array  $news
     * @param  string  $nameField
     * @param  string  $sourceIdField
     * @return array
     * @throws Throwable
     */
    protected function getAuthorFields(array $news, string $nameField, string $sourceIdField): array
    {
        return $this->getModelFields($news, ['name' => $nameField, 'source_id' => $sourceIdField], Author::class);
    }

    /**
     * @param  array  $news
     * @param  string  $nameField
     * @return array
     * @throws Throwable
     */
    protected function getSourceFields(array $news, string $nameField): array
    {
        return $this->getModelFields($news, ['name' => $nameField], Source::class);
    }

    /**
     * @param  array  $news
     * @param  string  $nameField
     * @return array
     * @throws Throwable
     */
    protected function getCategoryFields(array $news, string $nameField): array
    {
        return $this->getModelFields($news, ['name' => $nameField], Category::class);
    }

    /**
     * @param  array  $news
     * @param  array  $fields
     * @param  string  $modelNameSpace
     * @return array
     * @throws Throwable
     */
    private function getModelFields(array $news, array $fields, string $modelNameSpace): array
    {
        $modelFillable = (new $modelNameSpace)->getFillable();
        $modelFields = [];

        foreach ($fields as $key => $field) {
            $modelFields[$key] = $this->isDefaultValue($field)
                ? $this->getValueWithoutBrackets($field)
                : \Arr::get($news, $field);
        }

        throw_unless(count(array_filter($modelFields, function ($key) use ($modelFillable) {
                return in_array($key, $modelFillable);
            }, ARRAY_FILTER_USE_KEY)) === count($modelFields));

        return $modelFields;
    }

}
