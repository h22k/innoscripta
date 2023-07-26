<?php

namespace App\Components\News\Helpers;

trait DefaultValue
{

    /**
     * @param  string  $field
     * @return bool
     */
    private function isDefaultValue(string $field): bool
    {
        return \Str::startsWith($field, '{');
    }

    /**
     * @param  string  $field
     * @return string
     */
    private function getValueWithoutBrackets(string $field): string
    {
        return \Str::remove(['{', '}'], $field);
    }

}
