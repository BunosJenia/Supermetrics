<?php

declare(strict_types=1);

namespace App\Services\PostStatistics;

use App\Models\Post;

/**
 * Class PostsPerWeek
 *
 * This service calculate total posts split by week number.
 */
class PostsPerWeek extends AbstractPostsStatistics
{
    /**
     * @param Post $post
     */
    public function combine(Post $post): void
    {
        $weekNumber = $post->getPostWeekNumber();

        $this->combinedData[$weekNumber][] = $post->getMessageLength();
    }

    /**
     * @return array
     */
    public function calculate(): array
    {
        return array_map(
            function (array $data) {
                return count($data);
            },
            $this->combinedData
        );
    }

    /**
     * @return string
     */
    protected function getStatisticsHeaderText(): string
    {
        return "Total posts split by week number";
    }
}