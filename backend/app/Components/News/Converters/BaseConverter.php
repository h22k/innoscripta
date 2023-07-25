<?php

namespace App\Components\News\Converters;

use App\Models\News;
use Throwable;

abstract class BaseConverter implements NewsConvertable
{
    abstract protected function getFieldMap(): array;

    /**
     * @return array
     */
    private function getFillableFieldsFromNewsModel(): array
    {
        return (new News)->getFillable();
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
                $converted[$modelField] = \Arr::get($singleNews, $apiField);
            }

            return $converted;
        });
    }
}
