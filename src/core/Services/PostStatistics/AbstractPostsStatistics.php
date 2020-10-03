<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class AbstractPostsStatistics
 *
 * Combine data and make particular calculations for Posts.
 */
abstract class AbstractPostsStatistics
{
    /**
     * Store combined data which needed for calculation.
     *
     * @var array
     */
    protected array $combinedData = [];

    /**
     * Combine data for calculation.
     *
     * @param Post $post
     *
     * @return void
     */
    abstract public function combine(Post $post): void;

    /**
     * Make calculations and return result.
     *
     * @return array
     */
    abstract protected function calculate(): array;

    /**
     * Return calculation name.
     *
     * @return string
     */
    abstract protected function getStatisticsHeaderText(): string;

    /**
     * Return calculation name and result data.
     *
     * @return array
     */
    public function getResult(): array
    {
        return [$this->getStatisticsHeaderText() => $this->calculate()];
    }
}