<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class LongestPostPerMonth
 *
 * This service calculate longest post by character length per month.
 */
class LongestPostPerMonth extends AbstractPostsStatistics
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
                return max($data);
            },
            $this->combinedData
        );
    }

    /**
     * @return string
     */
    protected function getStatisticsHeaderText(): string
    {
        return "Longest post by character length per month";
    }
}