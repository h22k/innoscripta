<?php

namespace App\Components\News\Helpers;

readonly class PoolOption
{

    public function __construct(
        private string $increasedKey,
        private int $startIndex,
        private int $finishIndex,
    )
    {}

    /**
     * @return string
     */
    public function getIncreasedKey(): string
    {
        return $this->increasedKey;
    }

    /**
     * @return int
     */
    public function getStartIndex(): int
    {
        return $this->startIndex;
    }

    /**
     * @return int
     */
    public function getFinishIndex(): int
    {
        return $this->finishIndex;
    }
}
