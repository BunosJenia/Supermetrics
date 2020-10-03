<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class AveragePostLengthPerMonth
 *
 * This service calculate average character length of posts per month.
 */
class AveragePostLengthPerMonth extends AbstractPostsStatistics
{
    /**
     * @param Post $post
     */
    public function combine(Post $post): void
    {
        $month = $post->getPostMonth();

        $this->combinedData[$month][] = $post->getMessageLength();
    }

    /**
     * @return array
     */
    public function calculate(): array
    {
        return array_map(
            function (array $data) {
                return array_sum($data) / count($data);
            },
            $this->combinedData
        );
    }

    /**
     * @return string
     */
    protected function getStatisticsHeaderText(): string
    {
        return "Average character length of posts per month";
    }
}